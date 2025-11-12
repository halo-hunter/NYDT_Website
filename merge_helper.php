function mergeDueDates($dates, $info)
{
    $dates = is_array($dates) ? $dates : [];
    $info = is_array($info) ? $info : [];
    $max = max(count($dates), count($info));
    $dates = array_pad($dates, $max, null);
    $info = array_pad($info, $max, null);

    return array_values(array_filter(
        array_map(function ($d, $i) {
            return [$d, $i];
        }, $dates, $info),
        function ($pair) {
            return !is_null($pair[0]) || !is_null($pair[1]);
        }
    ));
}
