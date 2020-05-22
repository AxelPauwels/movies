<?php

/**
 * Check if the subscription is valid. Compare today's date with the descriptionData.
 * Check if this is less then 365 days. If so, it's valid
 *
 * @param $subscriptionDate
 * @return bool
 */
function subscriptionIsValid($subscriptionDate)
{
	$now = time(); // or your date as well
	$dateSubscription = strtotime($subscriptionDate);
	$dateDiff = $now - $dateSubscription;
	$numberOfDayDays = round($dateDiff / (60 * 60 * 24));

	if ($numberOfDayDays > 0 && $numberOfDayDays < 366) {
		return true;
	}

	return false;
}

/**
 * TestFunction: Return the number of days between today and the last subscription
 *
 * @param $subscriptionDate
 * @return false|float
 */
function getNumberOfDaysTestFunction($subscriptionDate)
{
	$now = time(); // or your date as well
	$dateSubscription = strtotime($subscriptionDate);
	$dateDiff = $now - $dateSubscription;
	$numberOfDayDays = round($dateDiff / (60 * 60 * 24));

	return $numberOfDayDays;
}
