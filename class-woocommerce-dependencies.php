<?php

class WooCommerce_Dependencies {
	/**
	 * Compares the provided version number to the current WooCommerce version
	 *
	 * @param string The required version to compare against
	 * @return bool Provided version is compatible, or false if failed
	 */
	public function compatible_woocommerce_version( $check_version ) {
		if ( $wc_version = $this->get_woocommerce_version() ) {
			$check_version = $this->sanitize_version_number( $check_version );
			$wc_version = $this->sanitize_version_number( $wc_version );

			return version_compare( $wc_version, $check_version, '>=' );
		}

		return false;
	}

	/**
	 * Returns the version number of the currently active WooCommerce plugin
	 *
	 * @return string/false WooCommerce plugin version or false if failed
	 */
	private function get_woocommerce_version() {
		global $woocommerce;
		
		if ( is_object( $woocommerce ) && isset( $woocommerce->version ) ) {
			return $woocommerce->version;
		}
		
		return false;
	}

	/**
	 * Returns a santized value of the provided version number
	 *
	 * @param string Version number to sanitize
	 * @return string Santized value of the provided version number
	 */
	private function sanitize_version_number( $version ) {
		$addition_prefixes = array( '-', '_' );

		foreach ( $addition_prefixes as $prefix ) {
			if ( $find = strstr( $version, $prefix ) ) {
				$version = str_replace( $find, '', $version );
			}
		}

		return $version;
	}
}