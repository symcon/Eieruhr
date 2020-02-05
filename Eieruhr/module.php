<?php
	class Eieruhr extends IPSModule {

		public function Create()
		{
			//Never delete this line!
			parent::Create();

			
			//Profiles
			//TODO?: Sart/Stop profile

			//Variables
			$this->RegisterVariableBoolean('Active', $this->Translate('Eggtimer'), '~Switch', 0);
			$this->EnableAction('Active');
			$this->RegisterVariableString('Remaining', $this->Translate('Remaining'), '', 0);

			//Timer
			$this->RegisterTimer('EggTimer', 0, 'EU_UpdateTimer($_IPS[\'TARGET\']);');

			//Properties
			$this->RegisterPropertyString('Time', '{"hour":0,"minute":10,"second":0}');
			$this->RegisterPropertyInteger('Interval', 5);

			//Attributes
			$this->RegisterAttributeInteger('TimerStarted', 0);
			$this->RegisterAttributeInteger('TimeSeconds', 0);
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
			
			$time = json_decode($this->ReadPropertyString('Time'), true);
			$this->SetValue('Remaining', sprintf('%02d:%02d:%02d', $time['hour'], $time['minute'], $time['second']));
			
			$this->WriteAttributeInteger('TimeSeconds', $time['hour'] * 60 * 60 + $time['minute'] * 60 +  $time['second']);
		}

		public function RequestAction($Ident, $Value)
		{
			switch ($Ident)
			{
				case 'Active':
					$this->SetActive($Value);
					break;
				default:
					throw new Exception('Invalid ident');
			}
		}

		public function UpdateTimer()
		{
			$remaining = time() - $this->ReadAttributeInteger('TimerStarted');
			if ( $remaining >= $this->ReadAttributeInteger('TimeSeconds'))
			{
				$this->SetValue('Remaining', '00:00:00');
				$this->SetTimerInterval('EggTimer', 0);
				sleep(2);
				$this->SetValue('Active', false);
				$this->SetValue('Remaining', $this->StringifyTime($this->ReadAttributeInteger('TimeSeconds')));
			}
			else
			{
				$this->SetValue('Remaining', $this->StringifyTime($this->ReadAttributeInteger('TimeSeconds') - $remaining));
				$this->SetTimerInterval('EggTimer', $this->ReadPropertyInteger('Interval') * 1000);
			} 
		}
		private function SetActive($active)
		{
			if ($active)
			{
				$this->StartTimer();
			} 
			else
			{
				$this->StopTimer();
			}

			$this->SetValue('Active', $active);
		}

		private function StartTimer()
		{
			$this->WriteAttributeInteger('TimerStarted', time());
			$this->SetTimerInterval('EggTimer', $this->ReadPropertyInteger('Interval') * 1000);
			$this->SendDebug('Timer-Info', 'Active', 0);
		}


		private function StopTimer()
		{
			$this->SetTimerInterval('EggTimer', 0);
			$this->SetValue('Remaining', $this->StringifyTime($this->ReadAttributeInteger('TimeSeconds')));
		}

		private function StringifyTime(int $seconds = 0)
		{
			return sprintf('%02d:%02d:%02d', ($seconds /(60 * 60)),($seconds / 60 % 60), $seconds % 60); 
		}

	}