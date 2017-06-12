<?php
namespace App\Services;
use App\Models\Loan;
use App\Models\RepaymentSchedule;
use DB;
use Carbon\Carbon;

class LoanService {

	protected $config;
	public function __construct($loan_config){
		$this->config = $loan_config;
	}

	public function saveLoan($loan_amount,$loan_term,$interest_rate,$start_month,$start_year,$loanToEdit = null){
		$this->checkLoanAmount($loan_amount);
		$this->checkLoanTerm($loan_term);
		$this->checkInterestRate($interest_rate);
		$this->checkMonth($start_month);
		$this->checkStartYear($start_year);

		$interest_per_month = $this->calculateInterestPerMonth($interest_rate);
		$pmt = $this->calculatePMT(	$loan_amount,
									$loan_term,
									$interest_per_month);

		$repaymentSchedules = $this->draftRepaymentSchedules($pmt,$loan_amount,$interest_per_month,$loan_term*12);
		$schedule_collection = [];
		$dt = Carbon::createFromDate($start_year, $start_month, 1)->subMonth();
		$payment_no = 1;
		foreach ($repaymentSchedules as $repaymentSchedule) {
			$schedule_collection[] = new RepaymentSchedule([
											'payment_no' => $payment_no++,
											'date' => $dt->addMonth()->copy(),
											'payment_amount' => $pmt,
											'principal' => $repaymentSchedule->principal,
											'interest' => $repaymentSchedule->interest,
											'balance' => $repaymentSchedule->outstanding_balance,
										]);
		}

		DB::beginTransaction();
		try{
			if (null === $loanToEdit) {
				$loan = Loan::create([
					'loan_amount' => $loan_amount,
					'loan_term' => $loan_term,
					'interest_rate' => $interest_rate,
				]);
			}
			else{
				$loan = $loanToEdit;
				$loan->loan_amount = $loan_amount;
				$loan->loan_term = $loan_term;
				$loan->interest_rate = $interest_rate;
				$loan->save();

				foreach ($loan->repaymentSchedules as $repaymentSchedule) {
					$repaymentSchedule->delete();
				}
			}
			
			$loan->repaymentSchedules()->saveMany($schedule_collection);
			DB::commit();
		}
		catch(\Exception $e){
			DB::rollback();
			throw $e;
		}
		return $loan;
	}

	public function deleteLoan($loan){
		DB::beginTransaction();
		try{
			foreach ($loan->repaymentSchedules as $repaymentSchedule) {
				$repaymentSchedule->delete();
			}
			$loan->delete();
			DB::commit();

		}
		catch(\Exception $e){
			DB::rolback();
			throw $e;
		}
		
		return true;
	}

	public function draftRepaymentSchedules(
		$pmt,
		$outstanding_balance,
		$interest_per_month,
		$month_amount,
		&$repaymentSchedules = [])
	{
		$interest = bcmul("$interest_per_month","$outstanding_balance",10);
		$principal = bcsub($pmt,"$interest",10);
		$repaymentSchedule = (object)[
			'interest' => "$interest",
			'principal' => $principal,
			'outstanding_balance' => bcsub("$outstanding_balance","$principal",10),
		];
		array_push($repaymentSchedules, $repaymentSchedule);

		if (--$month_amount == 0) {
			return $repaymentSchedules;
		}
		return $this->draftRepaymentSchedules(	$pmt,
												$repaymentSchedule->outstanding_balance,
												$interest_per_month,
												$month_amount,
												$repaymentSchedules);
	}

	public function calculatePMT($loan_amount,$loan_term,$interest_per_month){
		$r = $interest_per_month;

		//power
		$power = bcmul("$loan_term","-12",0);

		$numerator = bcmul("$loan_amount","$r",10);
		$denominator = bcsub("1", bcpow( bcadd("1","$r",10) , $power,10) ,10);
		$pmt = bcdiv($numerator,$denominator,10);
		return $pmt;
	}

	public function calculateInterestPerMonth($interest_rate){
		//first let change interest_rate to percent
		$irp = bcdiv("$interest_rate","100",10);
		//then calculate interest rate per month
		$r = bcdiv("$irp","12",10);
		return $r;
	}

	protected function checkLoanAmount($loan_amount){
		if ($loan_amount > $this->config['loan_amount']['max']) {
			throw new \Exception('Loan amount exceed maximum limit.');
		}
		else if($loan_amount < $this->config['loan_amount']['min']){
			throw new \Exception('Loan amount less than minimum limit.');
		}
	}

	protected function checkLoanTerm($loan_term){
		if ($loan_term > $this->config['loan_term']['max']) {
			throw new \Exception('Loan term exceed maximum limit.');
		}
		else if($loan_term < $this->config['loan_term']['min']){
			throw new \Exception('Loan term less than minimum limit.');
		}
	}

	protected function checkInterestRate($interest_rate){
		if ($interest_rate > $this->config['interest_rate']['max']) {
			throw new \Exception('Interest rate exceed maximum limit.');
		}
		else if($interest_rate < $this->config['interest_rate']['min']){
			throw new \Exception('Interest rate less than minimum limit.');
		}
	}

	protected function checkMonth($month){
		if (1 > $month ||  $month > 12) {
			throw new \Exception('Invalid Month.');
		}
	}

	protected function checkStartYear($start_year){
		if ($start_year > $this->config['start_year']['max']) {
			throw new \Exception('Start Year exceed maximum limit.');
		}
		else if($start_year < $this->config['start_year']['min']){
			throw new \Exception('Start Year less than minimum limit.');
		}
	}
}
