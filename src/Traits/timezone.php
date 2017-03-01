<?php

namespace Slakbal\HtmlBs4\Traits;

trait Timezone
{

	public function selectTimezone( $name, $label = null, $value = null, $help = null, $attributes = [ ] )
	{
		$options = $this->timezoneRegionedValues();

		return $this->selectField( $name, $label, $options, $value, $help, $attributes );
	}


	private function timezoneRegionedValues()
	{
		$regions = [
			'Africa'     => \DateTimeZone::AFRICA,
			'America'    => \DateTimeZone::AMERICA,
			'Antarctica' => \DateTimeZone::ANTARCTICA,
			'Asia'       => \DateTimeZone::ASIA,
			'Atlantic'   => \DateTimeZone::ATLANTIC,
			'Europe'     => \DateTimeZone::EUROPE,
			'Indian'     => \DateTimeZone::INDIAN,
			'Pacific'    => \DateTimeZone::PACIFIC,
		];
		$timezones = [ ];
		foreach( $regions as $name => $mask ) {
			$zones = \DateTimeZone::listIdentifiers( $mask );
			foreach( $zones as $timezone ) {
				// Lets sample the time there right now
				$time = new \DateTime( null, new \DateTimeZone( $timezone ) );
				// Those dumb Americans can't handle military time
				$usTime = $time->format( 'H' ) > 12 ? ' (' . $time->format( 'g:i a' ) . ')' : '';
				// Remove region name and add a sample time
				$timezones[ $name ][ $timezone ] = substr( $timezone, strlen( $name ) + 1 ) . ' - ' . $time->format( 'H:i' ) . $usTime;
			}
		}

		return $timezones;
	}


	private function timezoneOffsetValues()
	{
		static $regions = [
			\DateTimeZone::AFRICA,
			\DateTimeZone::AMERICA,
			\DateTimeZone::ANTARCTICA,
			\DateTimeZone::ASIA,
			\DateTimeZone::ATLANTIC,
			\DateTimeZone::AUSTRALIA,
			\DateTimeZone::EUROPE,
			\DateTimeZone::INDIAN,
			\DateTimeZone::PACIFIC,
		];

		$timezones = [ ];
		foreach( $regions as $region ) {
			$timezones = array_merge( $timezones, \DateTimeZone::listIdentifiers( $region ) );
		}

		$timezone_offsets = [ ];
		foreach( $timezones as $timezone ) {
			$tz = new \DateTimeZone( $timezone );
			$timezone_offsets[ $timezone ] = $tz->getOffset( new \DateTime );
		}

		// sort timezone by offset
		asort( $timezone_offsets );

		$timezone_list = [ ];
		foreach( $timezone_offsets as $timezone => $offset ) {
			$offset_prefix = $offset < 0 ? '-' : '+';
			$offset_formatted = gmdate( 'H:i', abs( $offset ) );

			$pretty_offset = "UTC${offset_prefix}${offset_formatted}";

			$timezone_list[ $timezone ] = "(${pretty_offset}) $timezone";
		}

		return $timezone_list;
	}
}