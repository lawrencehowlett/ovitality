<?php
class ReferralReport extends SS_Report {

    public function title() {
        return 'Top Referrals';
    }

    public function columns() {
        $fields = array(
            'Member.FullName' => 'Member', 
            'Member.Email' => 'Email'
        );

        return $fields;
    }

	public function parameterFields() {
		$fields = new FieldList(
			DateField::create('DateFrom', 'Date From')
				->setConfig('showcalendar', true)
				->setConfig('dateformat', 'YYYY-MM-dd'),
			DateField::create('DateTo', 'Date To')
				->setConfig('showcalendar', true)
				->setConfig('dateformat', 'YYYY-MM-dd')
		);

		return $fields;
	}  

    public function sourceRecords($params = null) {
        $referrals = Referral::get();
        echo $referrals->Count('MemberID');

		if (isset($params['DateFrom']) && $params['DateFrom']) {
			$referrals = $referrals->filter(array('Created:GreaterThan' => $params['DateFrom'] . ' 00:00:00'));
		}

		if (isset($params['DateTo']) && $params['DateTo']) {
			$referrals = $referrals->filter(array('Created:LessThan' => $params['DateTo'] . ' 23:59:59'));
		}

		//$referrals->sort('Count(*) DESC');

		/*foreach ($referrals as $referral) {
			$isReferral = $result->filter(array('MemberID' => $referral->MemberID))->First();
			if (!$isReferral) {
				$result->push($referral);
			}
		}*/

		return $referrals;
    }
}