<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 15/12/2
 * Time: 上午5:58
 */

namespace App\Util\Graphics;

use Illuminate\Http\Request;

use Intervention\Image\ImageManagerStatic as Image;

/**
 * 图片工具类
 *
 * Class ImageUtil
 * @package App\Util\Graphics
 */
class ImageUtil
{

    /**
     * 保存一个图片到指定目录
     *
     * @param \Symfony\Component\HttpFoundation\File\UploadedFile|array $img
     * @param string $folder
     * @param int $width
     * @param int $height
     * @return string
     *
     * @throws FileException if, for any reason, the dictionary could not be created
     */
    public static function saveImg($img, $folder, $width=300, $height=270)
    {
        $clientName = $img->getClientOriginalName();
        $tmpName = $img->getFilename();
        $realPath = $img->getRealPath();
        $extension = $img->getClientOriginalExtension();
        $mimeType = $img->getMimeType();
        $newName = md5(date('ymdhis') . $clientName) . "." . $extension;
        // 目录不存在，创建之
        if (!is_dir($folder)) {
            if (false === @mkdir($folder, 0777, true) && !is_dir($folder)) {
                throw new FileException(sprintf('Unable to create the "%s" directory', $folder));
            }
        } elseif (!is_writable($folder)) {
            throw new FileException(sprintf('Unable to write in the "%s" directory', $folder));
        }
        // resizing an uploaded file，这样会创建一张新的图片
        Image::make($img)->fit($width, $height)->save($folder . '/' . $newName);

        return $newName;
    }

    /**
     * 将request中的图片保存到指定目录
     *
     * @param Request $request
     * @param string $imgName
     * @param string $folder
     * @param int $width
     * @param int $height
     * @return mixed
     */
    public static function saveImgFromRequest(Request $request, $imgName, $folder, $width=300, $height=270)
    {
        if ($request->hasFile($imgName)) {
            $img = $request->file($imgName);
            if ($img->isValid()) {
                return static::saveImg($img, $folder, $width, $height);
            }
        }

        return null;
    }

    /**
     * 图片简单剪裁
     *
     * @param string $source_path 文件路径
     * @param int $target_width
     * @param int $target_height
     * @return bool
     */
    public static function imageCropper($source_path, $target_width, $target_height)
    {
        $source_info = getimagesize($source_path);
        $source_width  = $source_info[0];
        $source_height = $source_info[1];
        $source_mime   = $source_info['mime'];
        $source_ratio  = $source_height / $source_width;
        $target_ratio  = $target_height / $target_width;

        // 源图过高
        if ($source_ratio > $target_ratio) {

            $cropped_width  = $source_width;
            $cropped_height = $source_width * $target_ratio;
            $source_x = 0;
            $source_y = ($source_height - $cropped_height) / 2;

        // 源图过宽
        } else if ($source_ratio < $target_ratio) {

            $cropped_width  = $source_height / $target_ratio;
            $cropped_height = $source_height;
            $source_x = ($source_width - $cropped_width) / 2;
            $source_y = 0;

            // 源图适中
        } else {

            $cropped_width  = $source_width;
            $cropped_height = $source_height;
            $source_x = 0;
            $source_y = 0;
        }

        switch ($source_mime) {

            case 'image/gif':
                $source_image = imagecreatefromgif($source_path);
                break;
            case 'image/jpeg':
                $source_image = imagecreatefromjpeg($source_path);
                break;
            case 'image/png':
                $source_image = imagecreatefrompng($source_path);
                break;
            default:
                return false;
        }

        $target_image  = imagecreatetruecolor($target_width, $target_height);
        $cropped_image = imagecreatetruecolor($cropped_width, $cropped_height);


        // 裁剪
        imagecopy($cropped_image, $source_image, 0, 0, $source_x, $source_y, $cropped_width, $cropped_height);
        // 缩放
        imagecopyresampled($target_image, $cropped_image, 0, 0, 0, 0, $target_width, $target_height, $cropped_width, $cropped_height);
        //header('Content-Type: image/jpeg');
        head('Content-Type: ' . $source_mime);
        imagejpeg($target_image);
        imagedestroy($source_image);
        imagedestroy($target_image);
        imagedestroy($cropped_image);

    }
}