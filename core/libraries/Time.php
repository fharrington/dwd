<?


class Time {

	/*-------------------------------------------------------------------------------------------------
	
	-------------------------------------------------------------------------------------------------*/
	public static function offset($remote, $local = NULL, $now = NULL) {
	
		if ($local === NULL) {
			# Use the default timezone
			$local = date_default_timezone_get();
		}

		if (is_int($now)) {
			# Convert the timestamp into a string
			$now = date(DateTime::RFC2822, $now);
		}

		# Create timezone objects
		$zone_remote = new DateTimeZone($remote);
		$zone_local  = new DateTimeZone($local);

		# Create date objects from timezones
		$time_remote = new DateTime($now, $zone_remote);
		$time_local  = new DateTime($now, $zone_local);

		# Find the offset
		$offset = $zone_remote->getOffset($time_remote) - $zone_local->getOffset($time_local);

		return $offset;
	}



	/*-----------------------------------------------------------------------------------------------
	Always use this method instead of date() or time() to find out the current time so
	we are able to use the MIMIC_TIME feature when testing.
	-------------------------------------------------------------------------------------------------*/
	public static function now() {
	
		# Do the test with strtotime, otherwise it reads constants weird if they don't exist and this doesn't work right		
		if(@strtotime(MIMIC_TIME) > 0) {
			return strtotime(MIMIC_TIME);
		}
		else {
			return time();
		}
			
	}
	
	
	/*-------------------------------------------------------------------------------------------------
	$timestamp is usually application time, $timezone is usually the user's time
	-------------------------------------------------------------------------------------------------*/
	public static function display($timestamp, $time_format = NULL, $timezone = NULL) {
	
		# Avoid printing December 31 1969 if there is no timestamp
		if($timestamp <= 0) {
			return "";
		}
		else {
		
			# Priority of time format
			# 1. If it's passed in
			# 2. The App's TIME_FORMAT setting
			# 3. A default value we set here
			if($time_format) {
				
			}
			elseif(TIME_FORMAT) {
				$time_format = TIME_FORMAT;
			}
			else {
				$time_format = "F j, Y g:ia";
			}
		
			# If passed in a timezone, use that one
			if (!empty($timezone)) {
				$timestamp = $timestamp + self::offset($timezone);
			} 
			
			return date($time_format, $timestamp);
		}
		
		
		
		
	
	}
	

	/*-------------------------------------------------------------------------------------------------
	Given a timestamp, returns an english string with relative time like "2 hours ago"
	-------------------------------------------------------------------------------------------------*/
	public static function time_ago($datefrom, $dateto=-1) {
		
		// Defaults and assume if 0 is passed in that
		// its an error rather than the epoch
		
		if($datefrom<=0) { return "A long time ago"; }
		if($dateto==-1) { $dateto = time(); }
		
		// Calculate the difference in seconds betweeen
		// the two timestamps
		
		$difference = $dateto - $datefrom;
		
		// If difference is less than 60 seconds,
		// seconds is a good interval of choice
		
		if($difference < 60) {
			$interval = "s";
		}
		
		// If difference is between 60 seconds and
		// 60 minutes, minutes is a good interval
		elseif($difference >= 60 && $difference<60*60) {
			$interval = "n";
		}
		
		// If difference is between 1 hour and 24 hours
		// hours is a good interval
		elseif($difference >= 60*60 && $difference<60*60*24) {
			$interval = "h";
		}
		
		// If difference is between 1 day and 7 days
		// days is a good interval
		elseif($difference >= 60*60*24 && $difference<60*60*24*7) {
			$interval = "d";
		}
		
		// If difference is between 1 week and 30 days
		// weeks is a good interval
		elseif($difference >= 60*60*24*7 && $difference < 60*60*24*30) {
			$interval = "ww";
		}
		
		// If difference is between 30 days and 365 days
		// months is a good interval, again, the same thing
		// applies, if the 29th February happens to exist
		// between your 2 dates, the function will return
		// the 'incorrect' value for a day
		elseif($difference >= 60*60*24*30 && $difference < 60*60*24*365) {
			$interval = "m";
		}
		
		// If difference is greater than or equal to 365
		// days, return year. This will be incorrect if
		// for example, you call the function on the 28th April
		// 2008 passing in 29th April 2007. It will return
		// 1 year ago when in actual fact (yawn!) not quite
		// a year has gone by
		elseif($difference >= 60*60*24*365) {
			$interval = "y";
		}
		
		// Based on the interval, determine the
		// number of units between the two dates
		// From this point on, you would be hard
		// pushed telling the difference between
		// this function and DateDiff. If the $datediff
		// returned is 1, be sure to return the singular
		// of the unit, e.g. 'day' rather 'days'
		
		switch($interval) {
			
			case "m":
				$months_difference = floor($difference / 60 / 60 / 24 / 29);
				while (mktime(date("H", $datefrom), date("i", $datefrom),
					date("s", $datefrom), date("n", $datefrom)+($months_difference),
					date("j", $dateto), date("Y", $datefrom)) < $dateto)
				{
				$months_difference++;
				}
				$datediff = $months_difference;
				
				// We need this in here because it is possible
				// to have an 'm' interval and a months
				// difference of 12 because we are using 29 days
				// in a month
				
				if($datediff==12) {
					$datediff--;
				}
				
				$res = ($datediff==1) ? "$datediff month ago" : "$datediff months ago";
			break;
			
			case "y":
				$datediff = floor($difference / 60 / 60 / 24 / 365);
				$res = ($datediff==1) ? "$datediff year ago" : "$datediff years ago";
			break;
			
			case "d":
				$datediff = floor($difference / 60 / 60 / 24);
				$res = ($datediff==1) ? "$datediff day ago" : "$datediff days ago";
			break;
			
			case "ww":
				$datediff = floor($difference / 60 / 60 / 24 / 7);
				$res = ($datediff==1) ? "$datediff week ago" : "$datediff weeks ago";
			break;
			
			case "h":
				$datediff = floor($difference / 60 / 60);
				$res = ($datediff==1) ? "$datediff hour ago" : "$datediff hours ago";
			break;
			
			case "n":
				$datediff = floor($difference / 60);
				$res = ($datediff==1) ? "$datediff min ago" : "$datediff mins ago";
			break;
			
			case "s":
				$datediff = $difference;
				$res = ($datediff==1) ? "$datediff second ago" : "$datediff seconds ago";
			break;
		}
		
		return $res;
		
		}
		
		
} # eoc
