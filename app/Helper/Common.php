<?php

function joinGroup( $data ) {
	$result = [];
	if ( isset( $data ) && $data ) {
		foreach ( $data as $i ) {
			$result[] = $i->id;
		}
	}

	return $result;
}

/*
 * Get multi menu (3 floor)
 */

function setMultiMenu( $data ) {
	$return = [];
	foreach ( $data as $item ) {
		$child = [];
		foreach ( $data as $n => $i ) {
			$grand = [];

			if ( $i->parent_id == $item->id ) {
				unset( $data[ $n ] );
				foreach ( $data as $m => $j ) {
					if ( $j->parent_id == $i->id ) {
						$grand[] = $j;
						unset( $data[ $m ] );
					}
				}

				if ( isset( $grand ) && $grand ) {
					$i->grand = $grand;
				}

				$child[] = $i;
			}
		}

		if ( empty( $child ) && ( $item->parent_id == 0 || $item->parent_id == null ) ) {
			$return[] = $item;
		} else if ( ! empty( $child ) ) {
			$item->child = $child;
			$return[]    = $item;
		}

	}

	return $return;
}

function getAllParentsCategory( $data, $category_id, &$result ) {
	foreach ( $data as $k => $v ) {
		if ( $v->id == $category_id ) {
			$result[] = $v->id;
			unset( $data[ $k ] );
			if ( $v->parent_id == 0 ) {
				break;
			}
			getAllParentsCategory( $data, $v->parent_id, $result );
		} else {
			continue;
		}
	}
}

?>