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
        $this->SetValue('Time', 600);

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

        $this->StopTimer();
        $this->SetValue('Active', false);
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
        $remaining = time() - $this->ReadAttributeInteger('TimerStarted');
        if ($remaining >= $this->GetValue('Time')) {
            $this->SetValue('Remaining', '00:00:00');
            $this->SetTimerInterval('EggTimer', 0);
            $this->SetValue('Active', false);
            $this->SetValue('Remaining', $this->Translate('Off'));
        } else {
            $this->SetValue('Remaining', $this->StringifyTime($this->GetValue('Time') - $remaining));
            $this->SetTimerInterval('EggTimer', $this->ReadPropertyInteger('Interval') * 1000);
        }
    }
    private function SetActive($active)
    {
        if ($active) {
            $this->StartTimer();
        } else {
            $this->StopTimer();
        }

        $this->SetValue('Active', $active);
    }

    private function StartTimer()
    {
        $this->WriteAttributeInteger('TimerStarted', time());
        $this->SetTimerInterval('EggTimer', $this->ReadPropertyInteger('Interval') * 1000);
        $this->SetValue('Remaining', $this->StringifyTime($this->GetValue('Time')));
        $this->SendDebug('Timer-Info', 'Active', 0);
    }

    private function StopTimer()
    {
        $this->SetTimerInterval('EggTimer', 0);
        $this->SetValue('Remaining', $this->Translate('Off'));
    }

    private function StringifyTime(int $seconds)
    {
        return sprintf('%02d:%02d:%02d', ($seconds / (60 * 60)), ($seconds / 60 % 60), $seconds % 60);
    }
}
