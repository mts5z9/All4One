<?php

namespace all4one\Http\Controllers;

use all4one\User;
use all4one\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Support\Facades\DB;
use Khill\Lavacharts\Lavacharts;


class BusinessStatsController extends BusinessController
{

    //statistics
    public function showRewardStats($timePeriod)
    {
      $lava = new Lavacharts; // See note below for Laravel
      $months = $this->getMonths();
      $rewardTable = $lava->DataTable();
      $currentDay = date('d');
      $currentMonth = date('m');
      $currentYear = date('Y');
      $rewards = $this->getRewards();
      for($i=0;$i<count($rewards);$i++)
      {
        $rewardArray[$i] = ['number',$rewards[$i]->title];
      }
      switch($timePeriod){
        case 'year':
          for($i=0;$i<12;$i++)
          {
            $time = $months[$currentMonth-1]->value . " " . $currentYear;
            for($k=0;$k<count($rewards);$k++)
            {
              $rewardStats[$k] = DB::table('CLAIMED_REWARD')
                        ->where('rewardID',$rewards[$k]->rewardID)
                        ->whereMonth('CLAIMED_REWARD.claimTimeStamp', $currentMonth)
                        ->whereYear('CLAIMED_REWARD.claimTimeStamp', $currentYear)
                        ->get();
            }
            $claimArray[$i] = [$time];
            for($j=1;$j<count($rewards)+1;$j++)
            {
              $claimArray[$i][$j] = count($rewardStats[$j-1]);
            }
            if($currentMonth == 1)
            {
              $currentYear = $currentYear - 1;
              $currentMonth = 12;
            } else {
              $currentMonth = $currentMonth - 1;
            }
          }

          $rewardTable->addDateColumn('Month Year')
                       ->addColumns($rewardArray)
                       ->addRows($claimArray);

          $lava->LineChart('Rewards', $rewardTable, [
               'title' => 'Reward Statistics',
               'height' => 350,
               'width' => 1100,
               'legend' => [
                   'position' => 'in'
               ],
               'hAxis' => [
                   'format' => 'MMM \n y',
                   'gridlines' => [
                     'count' => $i
                   ]
               ]
          ]);

          break;
        case 'month':
          for($i=0;$i<31;$i++)
          {
            $time = $currentDay . " " . $months[$currentMonth-1]->value . " " . $currentYear;
            for($k=0;$k<count($rewards);$k++)
            {
              $rewardStats[$k] = DB::table('CLAIMED_REWARD')
                        ->where('rewardID',$rewards[$k]->rewardID)
                        ->whereDay('claimTimeStamp', $currentDay)
                        ->whereMonth('CLAIMED_REWARD.claimTimeStamp', $currentMonth)
                        ->whereYear('CLAIMED_REWARD.claimTimeStamp', $currentYear)
                        ->get();
            }
            $claimArray[$i] = [$time];
            for($j=1;$j<count($rewards)+1;$j++)
            {
              $claimArray[$i][$j] = count($rewardStats[$j-1]);
            }
            if($currentDay == 1)
            {
              if($currentMonth == 1)
              {
                $currentYear = $currentYear - 1;
                $currentMonth = 12;
              } else {
                $currentMonth = $currentMonth - 1;
              }
              $currentDay = $this->getMonthDays($currentMonth);
            } else {
              $currentDay = $currentDay - 1;
            }
          }
          $rewardTable->addDateColumn('Day Month Year')
                    ->addColumns($rewardArray)
                    ->addRows($claimArray);

          $lava->LineChart('Rewards', $rewardTable, [
              'title' => 'Reward Statistics',
              'height' => 350,
              'width' => 1100,
              'legend' => [
                  'position' => 'in'
              ],
              'hAxis' => [
                  'format' => 'MMM d, y',
                  'gridlines' => [
                    'count' => $i
                  ]
              ]
          ]);

          break;
        case 'week':
          for($i=0;$i<7;$i++)
          {
            $time = $currentDay . " " . $months[$currentMonth-1]->value . " " . $currentYear;
            for($k=0;$k<count($rewards);$k++)
            {
              $rewardStats[$k] = DB::table('CLAIMED_REWARD')
                        ->where('rewardID',$rewards[$k]->rewardID)
                        ->whereDay('claimTimeStamp', $currentDay)
                        ->whereMonth('CLAIMED_REWARD.claimTimeStamp', $currentMonth)
                        ->whereYear('CLAIMED_REWARD.claimTimeStamp', $currentYear)
                        ->get();
            }
            $claimArray[$i] = [$time];
            for($j=1;$j<count($rewards)+1;$j++)
            {
              $claimArray[$i][$j] = count($rewardStats[$j-1]);
            }
            if($currentDay == 1)
            {
              if($currentMonth == 1)
              {
                $currentYear = $currentYear - 1;
                $currentMonth = 12;
              } else {
                $currentMonth = $currentMonth - 1;
              }
              $currentDay = $this->getMonthDays($currentMonth);
            } else {
              $currentDay = $currentDay - 1;
            }
          }
          $rewardTable->addDateColumn('Day Month Year')
                    ->addColumns($rewardArray)
                    ->addRows($claimArray);

          $lava->LineChart('Rewards', $rewardTable, [
              'title' => 'Reward Statistics',
              'height' => 350,
              'width' => 1100,
              'legend' => [
                  'position' => 'in'
              ],
              'hAxis' => [
                  'format' => 'MMM d, y',
                  'gridlines' => [
                    'count' => $i
                  ]
              ]
          ]);

          break;
      }

      return view('business.statistics.rewardStats',['lava' => $lava]);
    }

    public function showScanStats($timePeriod)
    {
      $lava = new Lavacharts; // See note below for Laravel
      $months = $this->getMonths();
      $scanTable = $lava->DataTable();
      $currentDay = date('d');
      $currentMonth = date('m');
      $currentYear = date('Y');

      switch($timePeriod){
        case 'year':
          for($i=0;$i<12;$i++)
          {
            $time = $months[$currentMonth-1]->value . " " . $currentYear;
            $scans = DB::table('SCAN')
                      ->where('businessID',$this->getBusinessID())
                      ->whereMonth('timeStamp', $currentMonth)
                      ->whereYear('timeStamp', $currentYear)
                      ->get();
            $scanArray[$i] = [$time, count($scans)];
            if($currentMonth == 1)
            {
              $currentYear = $currentYear - 1;
              $currentMonth = 12;
            } else {
              $currentMonth = $currentMonth - 1;
            }
          }
          $scanTable->addDateColumn('Month Year')
                     ->addNumberColumn('Number of Scans')
                     ->addRows($scanArray);

         $lava->AreaChart('Scans', $scanTable, [
             'title' => 'Scan Statistics',
             'height' => 350,
             'width' => 1100,
             'legend' => [
                 'position' => 'in'
             ],
             'hAxis' => [
                 'format' => 'MMM \n y',
                 'gridlines' => [
                   'count' => $i
                 ]
             ]
         ]);

          break;
        case 'month':
          for($i=0;$i<31;$i++)
          {
            $time = $currentDay . " " . $months[$currentMonth-1]->value . " " . $currentYear;
            $scans = DB::table('SCAN')
              ->where('businessID',$this->getBusinessID())
              ->whereDay('timeStamp', $currentDay)
              ->whereMonth('timeStamp', $currentMonth)
              ->whereYear('timeStamp', $currentYear)
              ->get();
            $scanArray[$i] = [$time, count($scans)];
            if($currentDay == 1)
            {
              if($currentMonth == 1)
              {
                $currentYear = $currentYear - 1;
                $currentMonth = 12;
              } else {
                $currentMonth = $currentMonth - 1;
              }
              $currentDay = $this->getMonthDays($currentMonth);
            } else {
              $currentDay = $currentDay - 1;
            }
          }
          $scanTable->addDateColumn('Day Month Year')
                    ->addNumberColumn('Number of Scans')
                    ->addRows($scanArray);

          $lava->AreaChart('Scans', $scanTable, [
              'title' => 'Scan Statistics',
              'height' => 350,
              'width' => 1100,
              'legend' => [
                  'position' => 'in'
              ],
              'hAxis' => [
                  'format' => 'MMM d, y',
                  'gridlines' => [
                    'count' => $i
                  ]
              ]
          ]);

          break;
        case 'week':
          for($i=0;$i<7;$i++)
          {
            $time = $currentDay . " " . $months[$currentMonth-1]->value . " " . $currentYear;
            $scans = DB::table('SCAN')
              ->where('businessID',$this->getBusinessID())
              ->whereDay('timeStamp', $currentDay)
              ->whereMonth('timeStamp', $currentMonth)
              ->whereYear('timeStamp', $currentYear)
              ->get();
            $scanArray[$i] = [$time, count($scans)];
            if($currentDay == 1)
            {
              if($currentMonth == 1)
              {
                $currentYear = $currentYear - 1;
                $currentMonth = 12;
              } else {
                $currentMonth = $currentMonth - 1;
              }
              $currentDay = $this->getMonthDays($currentMonth);
            } else {
              $currentDay = $currentDay - 1;
            }
          }
          $scanTable->addDateColumn('Day Month Year')
                    ->addNumberColumn('Number of Scans')
                    ->addRows($scanArray);

          $lava->AreaChart('Scans', $scanTable, [
              'title' => 'Scan Statistics',
              'height' => 350,
              'width' => 1100,
              'legend' => [
                  'position' => 'in'
              ],
              'hAxis' => [
                  'format' => 'MMM d, y',
                  'gridlines' => [
                    'count' => $i
                  ]
              ]
          ]);

          break;
      }

      return view('business.statistics.scanStats',['lava' => $lava]);
    }

    public function getMonthDays($month)
    {
      if($month == 1 ||$month == 3 ||$month == 5 ||$month == 7 ||$month == 8 ||$month == 10 ||$month == 12)
      {
        return 31;
      }
      else if($month == 4 ||$month == 6 ||$month == 9 ||$month == 11)
      {
        return 30;
      }
      else
        return 28;
    }
}
