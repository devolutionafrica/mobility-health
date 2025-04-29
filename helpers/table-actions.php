<?php


if (!function_exists("dropdownMenu")) {
    function dropdownMenu(array $items): string
    {
        return '
        <button class="btn btn-sm btn-icon btn-text-secondary rounded-pill waves-effect dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>
        <div class="dropdown-menu dropdown-menu-end m-0">
        ' . implode("\n", $items) . '
        </div>
        ';
    }
}
if (!function_exists("dropdownMenuItem")) {
    function dropdownMenuItem(string $title, string $url, ?string $icon = null): string
    {
        $i = "";
        if ($icon != null) {
            $i = "<i class=\"$icon\"></i>";
        }
        return '<a href="' . $url . '" class="dropdown-item">' . $i . '<span>' . $title . '</span></a>';
    }
}

if (!function_exists("trLink")) {
    function trLink(string $title, string $url, ?string $icon = null, string $type = "label", string $color = "secondary"): string
    {
        $i = "";
        $bt = $type;
        if ($icon != null) {
            $i = '<i class="me-2 ' . $icon . '"></i>';
        }
        if ($type == "text") {
            $bt = "text";
        }
        return '<a href="' . $url . '" class="btn btn-' . $bt . '-' . $color . ' py-1 px-3" style="font-size: 14px">' . $i . '<span class="text-capitalize">' . $title . '</span></a>';
    }
}

if (!function_exists("trActions")) {
    function trActions(array $items): string
    {
        return '<div class="d-flex align-items-center gap-50">' . implode("\n", $items) . '</div>';
    }
}
if (!function_exists("status")) {
    function status(string $title,string $type="primary"): string
    {
        return '<span class="badge bg-label-'.$type.' me-1">'.$title.'</span>';
    }
}
if (!function_exists("profile")) {
    function profile(string $fullName,?string $path = null, ?string $url = null, ?string $subTitle = null): string
    {

        $_subTitle = "";
        if ($subTitle != null) {
            $_subTitle = '<span class="d-block small">' . $subTitle . '</span>';
        }
        $userView = $url ?? "";
        // For Avatar badge
        $stateNum = rand(1, 6);
        $states = ['success', 'danger', 'warning', 'info', 'dark', 'primary', 'secondary'];

        $state = $states[$stateNum];
        $name = $fullName;
        $_initials = explode(" ", $name);
        $initials = strtoupper(($_initials[0][0] ?? "") . ($_initials[1][0] ?? ""));

        if ($path===null){
            $output = '<span  class="avatar-initial rounded-circle bg-label-' . $state . '">' . $initials . '</span>';
        }else{
            $output = '<img style="width:32px;height:32px;" class="rounded-circle" alt="" src="'.$path.'" />';
        }

        // Creates full output for row
        $row_output =
            '<div class="d-flex justify-content-start align-items-center user-name">' .
            '<div class="avatar-wrapper">' .
            '<div class="avatar avatar-sm me-4 fw-bold">' .
            $output .
            '</div>' .
            '</div>' .
            '<div class="d-flex flex-column">' .
            '<a href="' .
            $userView .
            '" class="text-heading text-truncate fw-semibold"><span class="fw-medium">' .
            $name .
            '</span>' . '</a>' .
            $_subTitle .
            '</div>' .
            '</div>';
        return $row_output;
    }
}
