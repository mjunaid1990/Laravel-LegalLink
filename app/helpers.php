<?php

use App\Models\Settings;

if (!function_exists('flash_messages')) {

    function flash_messages($message, $icon = '', $action_btn_text = '', $url = '', $link_class = '') {
        $html = '';
        $html .= '<div class="d-flex justify-content-between align-items-center">';
        $html .= '<div class="not-info d-flex align-items-center">';
        if ($icon) {
            $html .= '<i class="' . $icon . '"></i>';
            $html .= '<span class="separator"></span>';
        }
        $html .= $message;

        $html .= '</div>';
        if ($action_btn_text) {
            $html .= '<div class="not-action">
			      		<a href="' . $url . '" class="btn btn-micustomer">' . $action_btn_text . '</a>
		    		</div>';
        }
        $html .= '</div>';

        return $html;
    }

}

function flash_messages_qr($message, $rewardId, $templateId) {
    $html = '';
    $html .= '<div class="d-flex justify-content-between align-items-center">';
    $html .= '<div class="not-info d-flex align-items-center">';
    $html .= $message;

    $html .= '</div>';
    $html .= '<div class="not-action">
                        <a href="javascript:void(0);" data-url="/vendor/stores/show-card/' . $rewardId . '/' . $templateId . '" class="btn btn-micustomer edit-form">Show Reward Card</a>
                </div>';

    $html .= '</div>';

    return $html;
}

if (!function_exists('isMobile')) {

    function isMobile() {
        return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
    }

}
if (!function_exists('ErrorsHtml')) {

    function ErrorsHtml($errors) {
        $html = '';
        if ($errors) {
            if (is_object($errors)) {
                foreach ($errors->all() as $error) {
                    $html .= '<p class="error-msg">' . $error . '</p>';
                }
            } else {
                foreach ($errors as $key => $val) {
                    $html .= '<p class="error-msg">' . $val . '</p>';
                }
            }
        }
        return $html;
    }

}

// Function that prints
// the required sequence
function split_number_into_equal_parts($amount, $minimum_spend_value, $arr = []) {

    for ($n = $minimum_spend_value; $n <= $amount; $n += $minimum_spend_value) {
        array_push($arr, $minimum_spend_value);
    }
    if ($n > $amount) {
        $total = array_sum($arr);
        $rem = $amount - $total;
        if ($rem > 0) {
            array_push($arr, $rem);
        }
    }

    return $arr;
}

function uuid4() {
    /* 32 random HEX + space for 4 hyphens */
    $out = bin2hex(random_bytes(18));

    $out[8] = "-";
    $out[13] = "-";
    $out[18] = "-";
    $out[23] = "-";

    /* UUID v4 */
    $out[14] = "4";

    /* variant 1 - 10xx */
    $out[19] = ["8", "9", "a", "b"][random_int(0, 3)];

    return $out;
}

function split_name($name) {
    $name = trim($name);
    $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
    $first_name = trim(preg_replace('#' . preg_quote($last_name, '#') . '#', '', $name));
    return array($first_name, $last_name);
}

function calculate_days_between_dates($from, $to) {
    $date1 = strtotime($from);
    $date2 = strtotime($to);
    $date_difference = $date2 - $date1;
    $result = round($date_difference / (60 * 60 * 24));
    return abs($result);
}

function generatePin($keyLength) {
    // Set a blank variable to store the key in
    $key = "";
    for ($x = 1; $x <= $keyLength; $x++) {
        // Set each digit
        $key .= random_int(1, 9);
    }
    return $key;
}

function get_months_arr() {
    return [
        '01' => 'Jan',
        '02' => 'Feb',
        '03' => 'Mar',
        '04' => 'Apr',
        '05' => 'May',
        '06' => 'Jun',
        '07' => 'Jul',
        '08' => 'Aug',
        '09' => 'Sep',
        '10' => 'Oct',
        '11' => 'Nov',
        '12' => 'Dec'
    ];
}

function csvtoarray($filename = '', $delimiter) {

    if (!file_exists($filename) || !is_readable($filename))
        return FALSE;
    $header = NULL;
    $data = array();

    if (($handle = fopen($filename, 'r')) !== FALSE) {
        while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE) {
            if (!$header) {
                $header = $row;
            } else {
                $data[] = array_combine($header, $row);
            }
        }
        fclose($handle);
    }
//    if(file_exists($filename)) @unlink($filename);

    return $data;
}

function csvstring_to_array($string, $separatorChar = ',', $enclosureChar = '"', $newlineChar = "\n") {
    // @author: Klemen Nagode
    $array = array();
    $size = strlen($string);
    $columnIndex = 0;
    $rowIndex = 0;
    $fieldValue = "";
    $isEnclosured = false;
    for ($i = 0; $i < $size; $i++) {

        $char = $string{$i};
        $addChar = "";

        if ($isEnclosured) {
            if ($char == $enclosureChar) {

                if ($i + 1 < $size && $string{$i + 1} == $enclosureChar) {
                    // escaped char
                    $addChar = $char;
                    $i++; // dont check next char
                } else {
                    $isEnclosured = false;
                }
            } else {
                $addChar = $char;
            }
        } else {
            if ($char == $enclosureChar) {
                $isEnclosured = true;
            } else {

                if ($char == $separatorChar) {

                    $array[$rowIndex][$columnIndex] = $fieldValue;
                    $fieldValue = "";

                    $columnIndex++;
                } elseif ($char == $newlineChar) {
                    echo $char;
                    $array[$rowIndex][$columnIndex] = $fieldValue;
                    $fieldValue = "";
                    $columnIndex = 0;
                    $rowIndex++;
                } else {
                    $addChar = $char;
                }
            }
        }
        if ($addChar != "") {
            $fieldValue .= $addChar;
        }
    }

    if ($fieldValue) { // save last field
        $array[$rowIndex][$columnIndex] = $fieldValue;
    }
    return $array;
}

function get_setting_value_by_key($key) {
    $setting = Settings::where('name', $key)->first();
    if ($setting) {
        return $setting->value;
    }
}

function check_if_product_in_session($product_id) {
    $cart = session()->get('cart');
    if ($cart) {
        foreach ($cart as $id => $details) {
            if ($details['product_id'] == $product_id) {
                return true;
            }
        }
    }
    return false;
}

function check_if_product_in_wishlist($product_id) {
    $cart = session()->get('wishlist');
    if ($cart) {
        foreach ($cart as $id => $details) {
            if ($details['product_id'] == $product_id) {
                return true;
            }
        }
    }
    return false;
}

function get_cart_total() {
    $cart = session()->get('cart');
    $total = 0;
    if ($cart) {
        foreach ($cart as $details) {
            $total += $details['price'] * $details['quantity'];
        }
    }
    return $total;
}

/**
 * This function will parse email template merge fields and replace with the corresponding merge fields passed before sending email
 * @param  object $template     template from database
 * @param  array $merge_fields available merge fields
 * @return object
 */
function _parse_agreement_template_variables($content, $merge_fields) {
    foreach ($merge_fields as $key => $val) {
        $content = str_ireplace($key, $val, $content);
    }
    return $content;
}

function strip_word_html($text, $allowed_tags = '<b><i><sup><sub><em><strong><u><p><h1><h2><h3><h4><h5><h6>') {
    mb_regex_encoding('UTF-8');
    //replace MS special characters first
    $search = array('/&lsquo;/u', '/&rsquo;/u', '/&ldquo;/u', '/&rdquo;/u', '/&mdash;/u');
    $replace = array('\'', '\'', '"', '"', '-');
    $text = preg_replace($search, $replace, $text);
    //make sure _all_ html entities are converted to the plain ascii equivalents - it appears
    //in some MS headers, some html entities are encoded and some aren't
    $text = html_entity_decode($text, ENT_QUOTES, 'UTF-8');
    //try to strip out any C style comments first, since these, embedded in html comments, seem to
    //prevent strip_tags from removing html comments (MS Word introduced combination)
    if (mb_stripos($text, '/*') !== FALSE) {
        $text = mb_eregi_replace('#/\*.*?\*/#s', '', $text, 'm');
    }
    //introduce a space into any arithmetic expressions that could be caught by strip_tags so that they won't be
    //'<1' becomes '< 1'(note: somewhat application specific)
    $text = preg_replace(array('/<([0-9]+)/'), array('< $1'), $text);
    $text = strip_tags($text, $allowed_tags);
    //eliminate extraneous whitespace from start and end of line, or anywhere there are two or more spaces, convert it to one
    $text = preg_replace(array('/^\s\s+/', '/\s\s+$/', '/\s\s+/u'), array('', '', ' '), $text);
    //strip out inline css and simplify style tags
    $search = array('#<(strong|b)[^>]*>(.*?)</(strong|b)>#isu', '#<(em|i)[^>]*>(.*?)</(em|i)>#isu', '#<u[^>]*>(.*?)</u>#isu');
    $replace = array('<b>$2</b>', '<i>$2</i>', '<u>$1</u>');
    $text = preg_replace($search, $replace, $text);
    //on some of the ?newer MS Word exports, where you get conditionals of the form 'if gte mso 9', etc., it appears
    //that whatever is in one of the html comments prevents strip_tags from eradicating the html comment that contains
    //some MS Style Definitions - this last bit gets rid of any leftover comments */
    $num_matches = preg_match_all("/\<!--/u", $text, $matches);
    if ($num_matches) {
        $text = preg_replace('/\<!--(.)*--\>/isu', '', $text);
    }
    return $text;
}
