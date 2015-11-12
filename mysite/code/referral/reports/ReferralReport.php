<?php
class ReferralReport extends SS_Report {

    public function title() {
        return 'Top Referrals';
    }

    public function columns() {
        $fields = array(
        	'FullName' => 'Name', 
        	'Email' => 'Email', 
        	'NumberOfReferrals' => 'Number of referrals'
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
    	$result = new ArrayList();
        $referrals = Referral::get()->sort('MemberID');

		if (isset($params['DateFrom']) && $params['DateFrom']) {
			$referrals = $referrals->filter(array('Created:GreaterThan' => $params['DateFrom'] . ' 00:00:00'));
		}

		if (isset($params['DateTo']) && $params['DateTo']) {
			$referrals = $referrals->filter(array('Created:LessThan' => $params['DateTo'] . ' 23:59:59'));
		}

		$groupedReferrals = GroupedList::create($referrals);
		$groupedReferrals = $groupedReferrals->GroupedBy('MemberID');

		foreach ($groupedReferrals as $referral) {
			$member = Member::get()->byID($referral->MemberID);
			$result->push(new ArrayData(array(
				'FullName' => $member->FirstName . ' ' . $member->Surname, 
				'Email' => $member->Email,
				'NumberOfReferrals' => $referrals->filter(array('MemberID' => $referral->MemberID))->Count()
			)));
		}

		$result = $result->sort('NumberOfReferrals DESC');

		return $result;
    }
}