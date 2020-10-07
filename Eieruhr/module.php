<?php

declare(strict_types=1);
class Eieruhr extends IPSModule
{
    public function Create()
    {
        //Never delete this line!
        parent::Create();

        //Variables
        $this->RegisterVariableBoolean('Active', $this->Translate('Active'), '~Switch', 0);
        $this->EnableAction('Active');

        $this->RegisterVariableInteger('Time', $this->Translate('Time in Seconds'), '', 10);
        $this->EnableAction('Time');
        if ($this->GetValue('Time') == 0) {
            $this->SetValue('Time', 600);
        }
        $this->RegisterVariableString('Remaining', $this->Translate('Remaining'), '', 20);

        //Timer
        $this->RegisterTimer('EggTimer', 0, 'EU_UpdateTimer($_IPS[\'TARGET\']);');

        //Properties
        $this->RegisterPropertyInteger('Interval', 5);

        //Attributes
        $this->RegisterAttributeInteger('TimerStarted', 0);
    }

    public function Destroy()
    {
        //Never delete this line!
        parent::Destroy();
    }

    public function ApplyChanges()
    {
        //Never delete this line!
        parent::ApplyChanges();

        $this->UpdateTimer();
    }

    public function RequestAction($Ident, $Value)
    {
        switch ($Ident) {
            case 'Active':
                $this->SetActive($Value);
                break;

            case 'Time':
                $this->SetValue($Ident, $Value);
                $this->SetActive(false);
                break;

            default:
                throw new Exception('Invalid ident');
        }
    }

    public function UpdateTimer()
    {
        if (!$this->GetValue('Active')) {
            return;
        }
        $remaining = $this->GetValue('Time') - (time() - $this->ReadAttributeInteger('TimerStarted'));
        if ($remaining <= 0) {
            $this->StopTimer();
        } else {
            $this->SetValue('Remaining', $this->StringifyTime($remaining));
            //The interval must not be greater than the remaining time
            $newInterval = $this->ReadPropertyInteger('Interval') > $remaining ? $remaining : $this->ReadPropertyInteger('Interval');
            $this->SetTimerInterval('EggTimer', $newInterval * 1000);
        }
    }

    private function SetActive($active)
    {
        $this->SetValue('Active', $active);
        if ($active) {
            $this->StartTimer();
        } else {
            $this->StopTimer();
        }
    }

    private function StartTimer()
    {
        $this->WriteAttributeInteger('TimerStarted', time());
        $this->UpdateTimer();
    }

    private function StopTimer()
    {
        $this->SetTimerInterval('EggTimer', 0);
        $this->SetValue('Remaining', $this->Translate('Off'));
        $this->WriteAttributeInteger('TimerStarted', 0);
        $this->SetValue('Active', false);
    }

    private function StringifyTime(int $seconds)
    {
        return sprintf('%02d:%02d:%02d', ($seconds / (60 * 60)), ($seconds / 60 % 60), $seconds % 60);
    }
}
