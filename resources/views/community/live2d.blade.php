<link href="/live2d/css/live2d.css" rel="stylesheet">
<div>
    <div id="landlord" style="left:5px;bottom:0px;">
        <div class="message" style="opacity:0"></div>
        <canvas id="live2d" width="500" height="560" class="live2d"></canvas>
        <div class="live_talk_input_body">
            <div class="live_talk_input_name_body">
                <input name="name" type="text" class="live_talk_name white_input" id="AIuserName" autocomplete="off" placeholder="你的名字" />
            </div>
            <div class="live_talk_input_text_body">
                <input name="talk" type="text" class="live_talk_talk white_input" id="AIuserText" autocomplete="off" placeholder="要和我聊什么呀？"/>
                <button type="button" class="live_talk_send_btn" id="talk_send">发送</button>
            </div>
        </div>
        <input name="live_talk" id="live_talk" value="1" type="hidden" />
        <div class="live_ico_box">
            <div class="live_ico_item type_info" id="showInfoBtn"></div>
            <div class="live_ico_item type_talk" id="showTalkBtn"></div>
            <div class="live_ico_item type_music" id="musicButton"></div>
            <div class="live_ico_item type_youdu" id="youduButton"></div>
            <div class="live_ico_item type_quit" id="hideButton"></div>
            <input name="live_statu_val" id="live_statu_val" value="0" type="hidden" />
            <audio src="" style="display:none;" id="live2d_bgm" data-bgm="0" preload="none"></audio>
            <input name="live2dBGM" value="音乐地址" type="hidden">
            <input id="duType" value="douqilai,l2d_caihong" type="hidden">
        </div>
    </div>
    <div id="open_live2d">召唤伊斯特瓦尔</div>
</div>
<script>
    var message_Path = '/live2d/';//资源目录，如果目录不对请更改
    var talkAPI = "/live2d/";//如果有类似图灵机器人的聊天接口请填写接口路径
</script>
<script type="text/javascript" src="/live2d/js/live2d.js"></script>
<script type="text/javascript" src="/live2d/js/message.js"></script>