<?php

function nullable($data){
    return !empty($data) ? $data : '<span class="text-danger">N/A</span>';
}
