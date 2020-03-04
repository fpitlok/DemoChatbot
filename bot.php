<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include 'vendor/autoload.php';



include 'bot_settings.php';
use LINE\LINEBot;
use LINE\LINEBot\HTTPClient;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot\Event;
use LINE\LINEBot\Event\BaseEvent;
use LINE\LINEBot\Event\MessageEvent;
use LINE\LINEBot\Event\AccountLinkEvent;
use LINE\LINEBot\Event\MemberJoinEvent; 
use LINE\LINEBot\MessageBuilder;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use LINE\LINEBot\MessageBuilder\StickerMessageBuilder;
use LINE\LINEBot\MessageBuilder\ImageMessageBuilder;
use LINE\LINEBot\MessageBuilder\LocationMessageBuilder;
use LINE\LINEBot\MessageBuilder\AudioMessageBuilder;
use LINE\LINEBot\MessageBuilder\VideoMessageBuilder;
use LINE\LINEBot\ImagemapActionBuilder;
use LINE\LINEBot\ImagemapActionBuilder\AreaBuilder;
use LINE\LINEBot\ImagemapActionBuilder\ImagemapMessageActionBuilder ;
use LINE\LINEBot\ImagemapActionBuilder\ImagemapUriActionBuilder;
use LINE\LINEBot\MessageBuilder\Imagemap\BaseSizeBuilder;
use LINE\LINEBot\MessageBuilder\ImagemapMessageBuilder;
use LINE\LINEBot\MessageBuilder\MultiMessageBuilder;
use LINE\LINEBot\TemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\DatetimePickerTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateMessageBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ButtonTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselColumnTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ConfirmTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ImageCarouselTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ImageCarouselColumnTemplateBuilder;
use LINE\LINEBot\QuickReplyBuilder;
use LINE\LINEBot\QuickReplyBuilder\QuickReplyMessageBuilder;
use LINE\LINEBot\QuickReplyBuilder\ButtonBuilder\QuickReplyButtonBuilder;
use LINE\LINEBot\TemplateActionBuilder\CameraRollTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\CameraTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\LocationTemplateActionBuilder;
use LINE\LINEBot\RichMenuBuilder;
use LINE\LINEBot\RichMenuBuilder\RichMenuSizeBuilder;
use LINE\LINEBot\RichMenuBuilder\RichMenuAreaBuilder;
use LINE\LINEBot\RichMenuBuilder\RichMenuAreaBoundsBuilder;
use LINE\LINEBot\Constant\Flex\ComponentIconSize;
use LINE\LINEBot\Constant\Flex\ComponentImageSize;
use LINE\LINEBot\Constant\Flex\ComponentImageAspectRatio;
use LINE\LINEBot\Constant\Flex\ComponentImageAspectMode;
use LINE\LINEBot\Constant\Flex\ComponentFontSize;
use LINE\LINEBot\Constant\Flex\ComponentFontWeight;
use LINE\LINEBot\Constant\Flex\ComponentMargin;
use LINE\LINEBot\Constant\Flex\ComponentSpacing;
use LINE\LINEBot\Constant\Flex\ComponentButtonStyle;
use LINE\LINEBot\Constant\Flex\ComponentButtonHeight;
use LINE\LINEBot\Constant\Flex\ComponentSpaceSize;
use LINE\LINEBot\Constant\Flex\ComponentGravity;
use LINE\LINEBot\MessageBuilder\FlexMessageBuilder;
use LINE\LINEBot\MessageBuilder\Flex\BubbleStylesBuilder;
use LINE\LINEBot\MessageBuilder\Flex\BlockStyleBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ContainerBuilder\BubbleContainerBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ContainerBuilder\CarouselContainerBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ComponentBuilder\BoxComponentBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ComponentBuilder\ButtonComponentBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ComponentBuilder\IconComponentBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ComponentBuilder\ImageComponentBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ComponentBuilder\SpacerComponentBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ComponentBuilder\FillerComponentBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ComponentBuilder\SeparatorComponentBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ComponentBuilder\TextComponentBuilder;


// ----------------------------------------------------------------------------------------------------- แบบ Template Message

$httpClient = new CurlHTTPClient(LINE_MESSAGE_ACCESS_TOKEN);
$bot = new LINEBot($httpClient, array('channelSecret' => LINE_MESSAGE_CHANNEL_SECRET));


$content = file_get_contents('php://input');



$events = json_decode($content, true);
if (!is_null($events)) {

    $replyToken = $events['events'][0]['replyToken'];
    $typeMessage = $events['events'][0]['message']['type'];
    $userMessage = $events['events'][0]['message']['text'];
    $userMessage = strtolower($userMessage);

    // $findme   = 'บัญชี';
    // $pos = strpos($userMessage, "บัญชี");

    if (strpos($userMessage, "บัญชี") == true) {
        $textReplyMessage = new BubbleContainerBuilder(
            "ltr",  // กำหนด NULL หรือ "ltr" หรือ "rtl"
            NULL,
            NULL,
            new BoxComponentBuilder(
                "horizontal",
                array(
                    new TextComponentBuilder("Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed 
                    do eiusmod tempor incididunt ut labore et dolore magna aliqua.", NULL, NULL, NULL, NULL, NULL, true)
                )
            ),
            new BoxComponentBuilder(
                "horizontal",
                array(
                    new ButtonComponentBuilder(
                        new UriTemplateActionBuilder("GO", "http://niik.in"),
                        NULL,
                        NULL,
                        NULL,
                        "primary"
                    )
                )
            )
        );

        $replyData = new FlexMessageBuilder("Flex", $textReplyMessage);
        
    $textReplyMessage = new BubbleContainerBuilder(
        "ltr",
        NULL,
        NULL,
        new BoxComponentBuilder(
            "vertical",
            array(
                new TextComponentBuilder("hello"),
                new TextComponentBuilder("world")
            )
        )
    );
    $replyData = new FlexMessageBuilder("This is a Flex Message", $textReplyMessage);
    }

    


    // if (strpos($userMessage, "บัญชี") == true) {
    //     $actionBuilder = array(
    //         new MessageTemplateActionBuilder(
    //             'รายละเอียดที่ 1',
    //             'ข้อมูลที่ 1'
    //         ),
    //         new MessageTemplateActionBuilder(
    //             'รายละเอียดที่ 2',
    //             'ข้อมูลที่ 2'
    //         ),
    //         new MessageTemplateActionBuilder(
    //             'รายละเอียดที่ 3',
    //             'ข้อมูลที่ 3'
    //         ),
    //         new UriTemplateActionBuilder(
    //             'รายละเอียดเพิ่มเติม',
    //             'https://www.google.com/?hl=th'
    //         ),
    //     );
    //     $imageUrl = 'https://lh3.googleusercontent.com/proxy/wn8c-FyKoyfCBsZ3uv5qVc79WzoqF3a8Kjy8P7SVLe_FPox9TQEdbYoEDP4Lac66hh4o2XIhLhP0vteCQOkZzeFgJId2h4NTtaDbiFHd48rLxGbbg0-PO_yw8gjdMIUyXCnf';
    //     $replyData = new TemplateMessageBuilder(
    //         'เปิดบัญชี',
    //         new ButtonTemplateBuilder(
    //             'เปิดบัญชี',
    //             'กรุณาเลือกหัวข้อที่ต้องการ',
    //             $imageUrl,
    //             $actionBuilder
    //         )
    //     );
    // }
//     if (strpos($userMessage, "ปัญหา") == true) {
//         $actionBuilder = array(
//             new MessageTemplateActionBuilder(
//                 'ปัญหาที่ 1',
//                 'รายละเอียดที่ 1'
//             ),
//             new MessageTemplateActionBuilder(
//                 'ปัญหาที่ 2',
//                 'รายละเอียดที่ 2'
//             ),
//             new MessageTemplateActionBuilder(
//                 'ปัญหาที่ 3',
//                 'รายละเอียดที่ 3'
//             ),
//             new UriTemplateActionBuilder(
//                 'รายละเอียดเพิ่มเติม',
//                 'https://www.google.com/?hl=th'
//             ),
//         );
//         $imageUrl = 'https://writerlisamason.com/wp-content/uploads/2019/02/4.jpg';
//         $replyData = new TemplateMessageBuilder(
//             'แจ้งปัญหา',
//             new ButtonTemplateBuilder(
//                 'แจ้งปัญหา',
//                 'กรุณาเลือกหัวข้อที่ต้องการ',
//                 $imageUrl,
//                 $actionBuilder
//             )
//         );
//     }
//     if ($userMessage == "รายละเอียดที่ 1") {
//         $actionBuilder = array(
//             new MessageTemplateActionBuilder(
//                 'เมนูที่ 1',
//                 'เมนูที่ 1'
//             ),
//             new MessageTemplateActionBuilder(
//                 'เมนูที่ 2',
//                 'เมนูที่ 2'
//             ),
//         );
//         $imageUrl = null;
//         $replyData = new TemplateMessageBuilder(
//             'รายละเอียดที่ 1',
//             new ButtonTemplateBuilder(
//                 'รายละเอียดที่ 1',
//                 'รายละเอียดของรายละเอียดที่ 1',
//                 $imageUrl,
//                 $actionBuilder
//             )
//         );
//     }
// }

$response = $bot->replyMessage($replyToken, $replyData);


echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
}