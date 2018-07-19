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

function setMultiCategoryLevel( $data, $parent_id = 0, $char = '' ) {
	if ( count( $data ) > 0 ) {
		foreach ( $data as $key => $item ) {
			if ( $item->parent_id == $parent_id ) {
				echo '<tr class="odd gradeX">';
				echo '<td>' . $item->id . '</td>';
				echo '<td>' . $char . ' ' . $item->name . '</td>';
				echo '<td>' . $item->slug . '</td>';
				echo '<td>' . $item->system_link_type->name . '</td>';

				if ( $item->status == 1 ) {
					echo '<td><span class="badge badge-info badge-roundless"> Approved </span></td>';
				} else {
					echo '<td><span class="badge badge-default badge-roundless"> No </span></td>';
				}

				echo '<td><form action="' . route( 'category.destroy', $item->id ) . '" method="POST">';
				echo method_field( 'DELETE' );
				echo csrf_field();
				echo '<a href="' . route( 'category.edit', [ 'category' => $item->id ] ) . '"class="btn red btn-sm">Update</a>';
				echo '<button type="button" class="btn red btn-sm btn-delete">Delete</button>';
				echo '</form></td></tr>';
				unset( $data[ $key ] );
				setMultiCategoryLevel( $data, $item->id, $char . '|---' );
			}
		}
	}
}

function setMultiCategorySelect( $data, $id_selected = null, $parent_id = 0, $char = '' ) {
	if ( count( $data ) > 0 ) {
		foreach ( $data as $key => $item ) {
			if ( $item->parent_id == $parent_id ) {
				if ( $item->id === $id_selected ) {
					echo '<option value="' . $item->id . '" selected>' . $char . $item->name . '</option>';
				} else {
					echo '<option value="' . $item->id . '">' . $char . $item->name . '</option>';
				}
				unset( $data[ $key ] );
				setMultiCategorySelect( $data, $id_selected, $item->id, $char . '|---' );
			}
		}
	}
}

function setMultiCategoryCheckBox( $data, $id_selected = null, $parent_id = 0, $level = 0, $name = 'parent' ) {
	if ( count( $data ) > 0 ) {

		foreach ( $data as $key => $item ) {
			if ( $item->parent_id == $parent_id ) {
				echo '<label class="mt-checkbox mt-level-' . $level . '">';
				if ( is_array( $id_selected ) && in_array( $item->id, $id_selected ) ) {
					echo '<input type="checkbox" value="' . $item->id . '" name="'.$name.'[]" checked >' . $item->name;
				} else {
					echo '<input type="checkbox" value="' . $item->id . '" name="'.$name.'[]" >' . $item->name;
				}
				echo '<span></span>';
				echo '</label>';

				unset( $data[ $key ] );
				setMultiCategoryCheckBox( $data, $id_selected, $item->id, $level + 1 );
			}
		}
	}
}

function showMenuBackend( $data, $parent_id = 0, $char = '' ) {
	$cate_child = [];
	if ( count( $data ) > 0 ) {
		foreach ( $data as $key => $item ) {
			if ( $item->parent_id == $parent_id ) {
				$cate_child[] = $item;
				unset( $data[ $key ] );
			}
		}
	}

	// Lấy danh sách chuyên mục con để xử lý tiếp
	if ( isset( $cate_child ) && $cate_child ) {
		echo '<ol class="dd-list">';
		foreach ( $cate_child as $item ) {
			echo '<li class="dd-item dd3-item" data-id="' . $item->id . '">';
			echo '<div class="dd-handle dd3-handle"> </div>';
			echo '<div class="dd3-content">' . $item->name . '
                    <i class="fa fa-times pull-right delete-item" data-id="' . $item->id . '"></i>
                </div>';
			showMenuBackend( $data, $item->id, '' );
		}
		echo '</ol>';
	}
}

function showMainNav( $data, $parent_id = 0 ) {
	$cate_child = [];
	if ( count( $data ) > 0 ) {
		foreach ( $data as $key => $item ) {
			if ( $item->parent_id == $parent_id ) {
				$cate_child[] = $item;
				unset( $data[ $key ] );
			}
		}
	}

	// Lấy danh sách chuyên mục con để xử lý tiếp
	if ( isset( $cate_child ) && $cate_child ) {
		echo '<ul>';
		foreach ( $cate_child as $item ) {
			echo '<li class="dd-item dd3-item" data-id="' . $item->id . '">';
			echo '<div class="dd-handle dd3-handle"> </div>';
			echo '<div class="dd3-content">' . $item->name . '
                    <i class="fa fa-times pull-right delete-item" data-id="' . $item->id . '"></i>
                </div>';
			showMenuBackend( $data, $item->id, '' );
		}
		echo '</ul>';
	}
}

function get_youtube_channel_ID( $url ) {
	$html = file_get_contents( $url );
	preg_match( "'<meta itemprop=\"channelId\" content=\"(.*?)\"'si", $html, $match );
	if ( $match && $match[1] ) {
		return $match[1];
	}
}

function renderDataWithClass( $content, $class ) {
	$content = nl2br( $content );
	$data    = explode( '<br />', $content );
	$item    = [];
	foreach ( $data as $i ) {
		$item[] = '<p class="' . $class . '">' . $i . '</p>';
	}
	$text = implode( '', $item );

	return $text;
}

function setUrlByType( $type, $slug, $direct = null, $route = null ) {
	switch ( $type ) {
		case 'game':
			return route( 'game.view', [ 'slug' => $slug ] );
			break;
		case 'page':
			return route( 'news.page', [ 'slug' => $slug ] );
			break;
		case 'direct':
			return $direct;
			break;
		case 'module':
			return route( $route );
			break;
		default:
			return route( 'news.category', [ 'slug' => $slug ] );
	}
}

?>