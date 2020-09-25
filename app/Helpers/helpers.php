<?php
if (! function_exists('include_route_files')) {
    /**
     * Loops through a folder and requires all PHP files
     * Searches sub-directories as well.
     *
     * @param $folder
     */
    function include_route_files($folder)
    {
        try {
            $rdi = new recursiveDirectoryIterator($folder);
            $it = new recursiveIteratorIterator($rdi);
            while ($it->valid()) {
                if (! $it->isDot() && $it->isFile() && $it->isReadable() && $it->current()->getExtension() === 'php') {
                    require $it->key();
                }
                $it->next();
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}

if (!function_exists('json')){
    /**
     * @param int $code code码
     * @param string $message 提示
     * @param null $data 数据
     * @param int $statusCode 状态码
     * @param array $headers
     * @param int $options 常量  （JSON_UNESCAPED_SLASHES JSON_PRETTY_PRINT JSON_NUMERIC_CHECK）
     * @return \Illuminate\Http\JsonResponse
     */
    function json(int $code, string $message, $data=null,$statusCode=200,array $headers = [],$options=0){
        $result = [
            'code' => $code,
            'message' => $message,
        ];
        if (!$data) {
            $result['data'] = [];
        }else{
            $result['data'] = $data;
        }
        return response()->json($result,$statusCode,$headers,$options);
    }
}
