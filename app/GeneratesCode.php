<?php

namespace App;

trait GeneratesCode
{
    /**
     * code order.
     */
    public static function bootGeneratesCode(){
        static::creating(function($model){
            do{
                // Tạo một chuỗi 5 chữ cái ngẫu nhiên không trùng nhau từ A-Z
                $letters = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 5);
                
                // Mã sẽ luôn bắt đầu bằng chữ "O", sau đó là 5 chữ cái ngẫu nhiên không trùng nhau
                $code = 'O' . $letters;
            } while(self::where('code', $code)->exists()); // Kiểm tra xem mã đã tồn tại trong cơ sở dữ liệu chưa.
            
            $model->code = $code;
        });
    }
}

