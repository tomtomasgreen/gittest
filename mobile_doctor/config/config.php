<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Base Site URL
|--------------------------------------------------------------------------
|
| URL to your CodeIgniter root. Typically this will be your base URL,
| WITH a trailing slash:
|
|	http://example.com/
|
| If this is not set then CodeIgniter will try guess the protocol, domain
| and path to your installation. However, you should always configure this
| explicitly and never rely on auto-guessing, especially in production
| environments.
|
*/
$config['base_url'] = 'http://app.diabetes.com.cn/guanhuai/';
//$config['base_url'] = 'http://wxtnbw.chinacloudsites.cn/guanhuai/';
$config['app_url'] = $config['base_url'] . 'doctor.php/';
$config['chat_timeout'] = 3000;
$config['collect_cost'] = 500;
$config['package_cost'] = 100;
$config['perpage_question'] = 20;
$config['perpage_dossier'] = 20;
$config['perpage_article'] = 20;
$config['qrcode_start'] = 21000;
$config['sugar_empty'] = array(4.4, 7);
$config['sugar_full'] = array(6.7, 10);

// 聊天积分白名单 - 地区
$config['whitelist_chat_province'] = array(
	1000	// 北京
	,3000	// 内蒙古
	,8500   // 河南
    ,14000  // 陕西
);
// 聊天积分白名单 - 城市 add by liweichen 9.23
$config['whitelist_chat_city'] = array(
);
// 聊天积分白名单 - 个人
$config['whitelist_chat_doctor'] = array(
	'13705398828'	// 山东	- 杜文华
	,'15163976106'	// 山东	- 刘昌盛
	,'18560083990'	// 山东	- 张晓黎
	,'13954908591'	// 山东	- 李富元
	,'18560083992'	// 山东	- 赖宏
	,'13011706860'	// 山东	- 刘素荣
	,'18805315978'	// 山东	- 杨文军
	,'13963673736'	// 山东	- 张毅
	,'13864140515'	// 山东	- 张珊珊
	,'18560085019'	// 山东	- 刘金波
	,'18560083995'	// 山东	- 孙宇
	,'13589688068'	// 山东	- 崇相义
	,'18560083989'	// 山东	- 陈丽
	,'13953988669'	// 山东	- 张怀国
	,'13505346551'	// 山东	- 王敏
	,'13370582873'	// 山东	- 姜强
	,'13864911058'	// 山东	- 刘淑霞
	,'18553376865'	// 山东	- 史晓艳
	,'13793923480'	// 山东	- 梁翠格
	,'18253908501'	// 山东	- 王学安
	,'13791104336'	// 山东	- 刘秀枝
	,'15168889958'	// 山东	- 孔磊
	,'13376348285'	// 山东	- 李雷
	,'13188888000'	// 山东	- 赵泉霖
	,'15666326182'	// 山东	- 王卫东
	,'13563043698'	// 山东	- 曹怀敏
	,'13563915089'	// 山东	- 李文侠
	,'18668987896'	// 山东	- 张丽君
	,'13370582791'	// 山东	- 付方明
	,'15092889280'	// 山东	- 董庆玉
	,'15168889310'	// 山东	- 王哲
	,'15318816220'	// 山东	- 尹晓
	,'13853955790'	// 山东	- 肖凤华
	,'13792964307'	// 山东	- 王月丽
	,'13184119090'	// 山东	- 董红
	,'18505333880'	// 山东	- 于会文
	,'15863265769'	// 山东	- 郭英
	,'15953152618'	// 山东	- 牟淑敏
	,'13869692771'	// 山东	- 张洁
	,'18678080529'	// 山东	- 王玉霞
	,'18753509195'	// 山东	- 金勇君
	,'15098201182'	// 山东	- 陈进荣
	,'18653795766'	// 山东	- 王增梅
	,'15666525182'	// 山东	- 路巍
	,'13589607040'	// 山东	- 王晓梅
	,'18560083987'	// 山东	- 任建民
	,'15562216759'	// 山东	- 冯爱萍
	,'15806300386'	// 山东	- 刘向阳
	,'13696326976'	// 山东	- 郝清顺
	,'13505468056'	// 山东	- 赵连礼
	,'15206713020'	// 山东	- 谭桂峰
	,'13954477369'	// 山东	- 张淼
	,'13969906806'	// 山东	- 徐方江
	,'15863159318'	// 山东	- 涂相柏
	,'13608931936'	// 山东	- 傅希灵
	,'15863615701'	// 山东	- 付效国
	,'15315356691'	// 山东	- 吕益奎
	,'18660639516'	// 山东	- 明义
	,'15318816219'	// 山东	- 王淑芳
	,'13869081995'	// 山东	- 于京涛
	,'13792197907'	// 山东	- 孙爱东
	,'13361257801'	// 山东	- 于民民
	,'15505353339'	// 山东	- 孟晓梅
	,'15254938831'	// 山东	- 谷兴军
	,'18678186512'	// 山东	- 赵晓东
	,'13863568298'	// 山东	- 杜洪泉
	,'15064013055'	// 山东	- 于汶津
	,'15192278999'	// 山东	- 臧仁涛
	,'18663815237'	// 山东	- 孙彩霞
	,'15864968658'	// 山东	- 周东浩
	,'18678186510'	// 山东	- 王淑娟
	,'13508944926'	// 山东	- 岳建美
	,'13573764941'	// 山东	- 钱光芳
	,'15666021567'	// 山东	- 井庆平
	,'13791428449'	// 山东	- 杨传梅
	,'18954106606'	// 山东	- 李鹏
	,'13515328555'	// 山东	- 王娜
	,'18606465209'	// 山东	- 邱云霞
	,'18605468717'	// 山东	- 刘红艳
	,'13053731032'	// 山东	- 尤文君
	,'13562310066'	// 山东	- 王继平
	,'13054693069'	// 山东	- 陈新焰
	,'13306452889'	// 山东	- 杜积慧
	,'18906306829'	// 山东	- 王丽静
	,'18053123405'	// 山东	- 白秀燕
	,'13963870509'	// 山东	- 李春英
	,'13668652023'	// 山东	- 邢春萍
	,'13563686637'	// 山东	- 韩佳琳
	,'13061507560'	// 山东	- 徐少全
	,'15966704850'	// 山东	- 鹿丽
	,'18660865869'	// 山东	- 郭征东
	,'13181088317'	// 山东	- 闫向东
	,'13153105986'	// 山东	- 赵淑淼
	,'13791122909'	// 山东	- 侯为开
	,'13853951365'	// 山东	- 王忠富
	,'15864920706'	// 山东	- 苏旭东
	,'15563106009'	// 山东	- 王朋波
	,'15910130281'	// 山东	- 刘莹
	,'15589006602'	// 山东	- 厉东亚
	,'13563230686'	// 山东	- 王开芹
	,'13561547364'	// 山东	- 李志刚
	,'13953440921'	// 山东	- 徐天英
	,'13455374678'	// 山东	- 邵明冉
	,'13583601019'	// 山东	- 郭世彪
	,'13963610170'	// 山东	- 程丽霞
	,'15589527155'	// 山东	- 王思明
	,'13953472941'	// 山东	- 张静
	,'18766866133'	// 山东	- 张爱民
	,'13395468205'	// 山东	- 赵桂东
	,'18953533512'	// 山东	- 辛梅芳
	,'15168888303'	// 山东	- 张海清
	,'15168889956'	// 山东	- 韩文霞
	,'15168867396'	// 山东	- 姜秀云
	,'13606370181'	// 山东	- 薛建国
	,'18560083991'	// 山东	- 董明
	,'18560080308'	// 山东	- 侯新国
	
	//add li weichen 0931
	,'18554301318'	//山东省	- 于文
	//,'13583601019'	//山东省	- 郭世彪
	,'18953385266'	//山东省	- 徐艳华
	//,'18606465209'	//山东省	- 邱云霞
	//,'13395468205'	//山东省	- 赵桂东
	,'13954905921'	//山东省	- 姚涤非
	//,'13864911058'	//山东省	- 刘淑霞
	,'13706375718'	//山东省	- 吴庆永
	//,'15589006602'	//山东省	- 厉东亚
	,'13655391840'	//山东省	- 宋长虹
	,'15563635869'	//山东省	- 徐希坤
	,'15192835972'	//山东省	- 杜晓明
	,'13869994518'	//山东省	- 马文杰
	,'15563002151'	//山东省	- 张志华
	,'15020321043'	//山东省	- 曹怡玲
	//,'15254938831'	//山东省	- 谷兴军
	//,'13969906806'	//山东省	- 徐方江
	,'13723922588'	//山东省	- 赵红霞
	,'13563734748'	//山东省	- 杨中新
	,'13505439008'	//山东省	- 薛海波
	,'15506308728'	//山东省	- 王秀云
	,'13954666567'	//山东省	- 徐涛
	,'13181023588'	//山东省	- 魏锋
	,'13562435328'	//山东省	- 赵秀伟
	,'18561728089'	//山东省	- 吴宁
	,'18561810903'	//山东省	- 孙靖
	,'18678989135'	//山东省	- 刘淑娟
	,'13869698986'	//山东省	- 刘海霞
	,'15866163986'	//山东省	- 周艳花
	,'15552201885'	//山东省	- 王丽娜
	,'13705356829'	//山东省	- 刘建军
	,'15666303077'	//山东省	- 于红岩
	//,'18766866133'	//山东省	- 张爱民
	,'18953785706'	//山东省	- 王传中
	//,'15206713020'	//山东省	- 谭桂峰
	,'15966110266'	//山东省	- 高明殿
	,'13583024170'	//山东省	- 高志英
	,'13176120868'	//山东省	- 牛永国
	//,'18660865869'	//山东省	- 郭征东
	,'13563771686'	//山东省	- 黄显丰
	,'15265722112'	//山东省	- 陈翠芝
	,'15153169790'	//山东省	- 刘元涛
	//,'13053731032'	//山东省	- 尤文君
	,'13405309111'	//山东省	- 牛东升
	,'15621043130'	//山东省	- 毛军
	,'17072872826'	//山东省	- 陈桂芝
	,'18553135690'	//山东省	- 王东
	,'13869996056'	//山东省	- 黄秋静
	,'15153996197'	//山东省	- 朱洁
	,'13561108096'	//山东省	- 庞德水
	,'15953917377'	//山东省	- 宋仪利
	,'13869900778'	//山东省	- 高冠起
	,'13561196726'	//山东省	- 王德忠
	,'13181770432'  //山东省	- 唐先格
);
// 加粉积分黑名单 - 地区
$config['blacklist_relation_province'] = array(
	8000	// 山东
	,1500	// 天津
	,5000	// 上海
);
// 加粉积分白名单 - 个人
$config['whitelist_relation_doctor'] = array(
	'13705398828'	// 山东	- 杜文华
	,'15163976106'	// 山东	- 刘昌盛
	,'18560083990'	// 山东	- 张晓黎
	,'13954908591'	// 山东	- 李富元
	,'18560083992'	// 山东	- 赖宏
	,'13011706860'	// 山东	- 刘素荣
	,'18805315978'	// 山东	- 杨文军
	,'13963673736'	// 山东	- 张毅
	,'13864140515'	// 山东	- 张珊珊
	,'18560085019'	// 山东	- 刘金波
	,'18560083995'	// 山东	- 孙宇
	,'13589688068'	// 山东	- 崇相义
	,'18560083989'	// 山东	- 陈丽
	,'13953988669'	// 山东	- 张怀国
	,'13505346551'	// 山东	- 王敏
	,'13370582873'	// 山东	- 姜强
	,'13864911058'	// 山东	- 刘淑霞
	,'18553376865'	// 山东	- 史晓艳
	,'13793923480'	// 山东	- 梁翠格
	,'18253908501'	// 山东	- 王学安
	,'13791104336'	// 山东	- 刘秀枝
	,'15168889958'	// 山东	- 孔磊
	,'13376348285'	// 山东	- 李雷
	,'13188888000'	// 山东	- 赵泉霖
	,'15666326182'	// 山东	- 王卫东
	,'13563043698'	// 山东	- 曹怀敏
	,'13563915089'	// 山东	- 李文侠
	,'18668987896'	// 山东	- 张丽君
	,'13370582791'	// 山东	- 付方明
	,'15092889280'	// 山东	- 董庆玉
	,'15168889310'	// 山东	- 王哲
	,'15318816220'	// 山东	- 尹晓
	,'13853955790'	// 山东	- 肖凤华
	,'13792964307'	// 山东	- 王月丽
	,'13184119090'	// 山东	- 董红
	,'18505333880'	// 山东	- 于会文
	,'15863265769'	// 山东	- 郭英
	,'15953152618'	// 山东	- 牟淑敏
	,'13869692771'	// 山东	- 张洁
	,'18678080529'	// 山东	- 王玉霞
	,'18753509195'	// 山东	- 金勇君
	,'15098201182'	// 山东	- 陈进荣
	,'18653795766'	// 山东	- 王增梅
	,'15666525182'	// 山东	- 路巍
	,'13589607040'	// 山东	- 王晓梅
	,'18560083987'	// 山东	- 任建民
	,'15562216759'	// 山东	- 冯爱萍
	,'15806300386'	// 山东	- 刘向阳
	,'13696326976'	// 山东	- 郝清顺
	,'13505468056'	// 山东	- 赵连礼
	,'15206713020'	// 山东	- 谭桂峰
	,'13954477369'	// 山东	- 张淼
	,'13969906806'	// 山东	- 徐方江
	,'15863159318'	// 山东	- 涂相柏
	,'13608931936'	// 山东	- 傅希灵
	,'15863615701'	// 山东	- 付效国
	,'15315356691'	// 山东	- 吕益奎
	,'18660639516'	// 山东	- 明义
	,'15318816219'	// 山东	- 王淑芳
	,'13869081995'	// 山东	- 于京涛
	,'13792197907'	// 山东	- 孙爱东
	,'13361257801'	// 山东	- 于民民
	,'15505353339'	// 山东	- 孟晓梅
	,'15254938831'	// 山东	- 谷兴军
	,'18678186512'	// 山东	- 赵晓东
	,'13863568298'	// 山东	- 杜洪泉
	,'15064013055'	// 山东	- 于汶津
	,'15192278999'	// 山东	- 臧仁涛
	,'18663815237'	// 山东	- 孙彩霞
	,'15864968658'	// 山东	- 周东浩
	,'18678186510'	// 山东	- 王淑娟
	,'13508944926'	// 山东	- 岳建美
	,'13573764941'	// 山东	- 钱光芳
	,'15666021567'	// 山东	- 井庆平
	,'13791428449'	// 山东	- 杨传梅
	,'18954106606'	// 山东	- 李鹏
	,'13515328555'	// 山东	- 王娜
	,'18606465209'	// 山东	- 邱云霞
	,'18605468717'	// 山东	- 刘红艳
	,'13053731032'	// 山东	- 尤文君
	,'13562310066'	// 山东	- 王继平
	,'13054693069'	// 山东	- 陈新焰
	,'13306452889'	// 山东	- 杜积慧
	,'18906306829'	// 山东	- 王丽静
	,'18053123405'	// 山东	- 白秀燕
	,'13963870509'	// 山东	- 李春英
	,'13668652023'	// 山东	- 邢春萍
	,'13563686637'	// 山东	- 韩佳琳
	,'13061507560'	// 山东	- 徐少全
	,'15966704850'	// 山东	- 鹿丽
	,'18660865869'	// 山东	- 郭征东
	,'13181088317'	// 山东	- 闫向东
	,'13153105986'	// 山东	- 赵淑淼
	,'13791122909'	// 山东	- 侯为开
	,'13853951365'	// 山东	- 王忠富
	,'15864920706'	// 山东	- 苏旭东
	,'15563106009'	// 山东	- 王朋波
	,'15910130281'	// 山东	- 刘莹
	,'15589006602'	// 山东	- 厉东亚
	,'13563230686'	// 山东	- 王开芹
	,'13561547364'	// 山东	- 李志刚
	,'13953440921'	// 山东	- 徐天英
	,'13455374678'	// 山东	- 邵明冉
	,'13583601019'	// 山东	- 郭世彪
	,'13963610170'	// 山东	- 程丽霞
	,'15589527155'	// 山东	- 王思明
	,'13953472941'	// 山东	- 张静
	,'18766866133'	// 山东	- 张爱民
	,'13395468205'	// 山东	- 赵桂东
	,'18953533512'	// 山东	- 辛梅芳
	,'15168888303'	// 山东	- 张海清
	,'15168889956'	// 山东	- 韩文霞
	,'15168867396'	// 山东	- 姜秀云
	,'13606370181'	// 山东	- 薛建国
	,'18560083991'	// 山东	- 董明
	,'18560080308'	// 山东	- 侯新国
	
	,'18920070350'	// 张艳
	,'13602187593'	// 张优蕊
	,'15620062577'	// 宁书和
	,'18622431543'	// 张婷
	,'13920135637'	// 李凤英
	,'13512848750'	// 索艳
	,'13512026870'	// 蔡春沉
	,'13820167696'	// 袁捷
	,'13612029869'	// 曹俊英
	,'13516181650'	// 刘丽娜
	,'13022291644'	// 方秀梅
	,'15222501665'	// 刘冬梅
	,'18920232652'	// 王新
	,'13752737472'	// 王德满
	,'13602193266'	// 王金芳
	,'13820139218'	// 高玉梅
	,'13920628276'	// 崔洪臣
	,'13820332999'	// 徐秀华
	,'15122481737'	// 葛焕琦
	
	//add li weichen 0931
	,'18554301318'	//山东省	- 于文
	//,'13583601019'	//山东省	- 郭世彪
	,'18953385266'	//山东省	- 徐艳华
	//,'18606465209'	//山东省	- 邱云霞
	//,'13395468205'	//山东省	- 赵桂东
	,'13954905921'	//山东省	- 姚涤非
	//,'13864911058'	//山东省	- 刘淑霞
	,'13706375718'	//山东省	- 吴庆永
	//,'15589006602'	//山东省	- 厉东亚
	,'13655391840'	//山东省	- 宋长虹
	,'15563635869'	//山东省	- 徐希坤
	,'15192835972'	//山东省	- 杜晓明
	,'13869994518'	//山东省	- 马文杰
	,'15563002151'	//山东省	- 张志华
	,'15020321043'	//山东省	- 曹怡玲
	//,'15254938831'	//山东省	- 谷兴军
	//,'13969906806'	//山东省	- 徐方江
	,'13723922588'	//山东省	- 赵红霞
	,'13563734748'	//山东省	- 杨中新
	,'13505439008'	//山东省	- 薛海波
	,'15506308728'	//山东省	- 王秀云
	,'13954666567'	//山东省	- 徐涛
	,'13181023588'	//山东省	- 魏锋
	,'13562435328'	//山东省	- 赵秀伟
	,'18561728089'	//山东省	- 吴宁
	,'18561810903'	//山东省	- 孙靖
	,'18678989135'	//山东省	- 刘淑娟
	,'13869698986'	//山东省	- 刘海霞
	,'15866163986'	//山东省	- 周艳花
	,'15552201885'	//山东省	- 王丽娜
	,'13705356829'	//山东省	- 刘建军
	,'15666303077'	//山东省	- 于红岩
	//,'18766866133'	//山东省	- 张爱民
	,'18953785706'	//山东省	- 王传中
	//,'15206713020'	//山东省	- 谭桂峰
	,'15966110266'	//山东省	- 高明殿
	,'13583024170'	//山东省	- 高志英
	,'13176120868'	//山东省	- 牛永国
	//,'18660865869'	//山东省	- 郭征东
	,'13563771686'	//山东省	- 黄显丰
	,'15265722112'	//山东省	- 陈翠芝
	,'15153169790'	//山东省	- 刘元涛
	//,'13053731032'	//山东省	- 尤文君
	,'13405309111'	//山东省	- 牛东升
	,'15621043130'	//山东省	- 毛军
	,'17072872826'	//山东省	- 陈桂芝
	,'18553135690'	//山东省	- 王东
	,'13869996056'	//山东省	- 黄秋静
	,'15153996197'	//山东省	- 朱洁
	,'13561108096'	//山东省	- 庞德水
	,'15953917377'	//山东省	- 宋仪利
	,'13869900778'	//山东省	- 高冠起
	,'13561196726'	//山东省	- 王德忠
	,'13181770432'  //山东省	- 唐先格
);
// 智库答题黑名单 - 地区
$config['blacklist_collect_province'] = array(
	8000	// 山东
	,1500	// 天津
	,5000	// 上海
);
// 智库答题白名单 - 个人
$config['whitelist_collect_doctor'] = array(
	'13655391840'	// 山东	- 宋长虹
	,'15192835972'	// 山东	- 杜晓明
	,'13869994518'	// 山东	- 马文杰
	,'13361230910'	// 山东	- 曲庚汝
	,'13706425201'	// 山东	- 白春英
	,'13006569044'	// 山东	- 王静
	,'13002731005'	// 山东	- 朱洁
	,'13953522196'	// 山东	- 于进堂
	,'13963100898'	// 山东	- 苗林艳
	,'18953785706'	// 山东	- 王传中
	,'13963673736'	// 山东	- 张毅
	,'13869996056'	// 山东	- 黄秋静
	,'15153270588'	// 山东	- 张磊
	,'13863773804'	// 山东	- 陈翠云
	,'13953709849'	// 山东	- 马运芝
	,'15854365821'	// 山东	- 高爱滨
	,'13001790583'	// 山东	- 李洪生
	,'13864855820'	// 山东	- 邹彦
	,'15588661901'	// 山东	- 李光善
	,'18605308028'	// 山东	- 史海涛
	,'13864957600'	// 山东	- 秦婧
	,'13954905921'	// 山东	- 姚涤非
	,'18553262733'	// 山东	- 龚敏
	,'13906424480'	// 山东	- 陶璐
	,'15020321043'	// 山东	- 曹怡玲
	,'13869931228'	// 山东	- 于凤泉
	,'13854779268'	// 山东	- 周卫东
	,'13705356829'	// 山东	- 刘建军
	,'15563635869'	// 山东	- 徐希坤
	,'13685356792'	// 山东	- 张凌云
	,'13562435328'	// 山东	- 赵秀伟
	,'13181770432'	// 山东	- 唐先格
	,'13705398828'	// 杜文华
	,'15163976106'	// 刘昌盛
	,'18560083990'	// 张晓黎
	,'13954908591'	// 李富元
	,'18560083992'	// 赖宏
	,'13011706860'	// 刘素荣
	,'18805315978'	// 杨文军
	,'13963673736'	// 张毅
	,'13864140515'	// 张珊珊
	,'18560085019'	// 刘金波
	,'18560083995'	// 孙宇
	,'13589688068'	// 崇相义
	,'18560083989'	// 陈丽
	,'13953988669'	// 张怀国
	,'13505346551'	// 王敏
	,'13370582873'	// 姜强
	,'13864911058'	// 刘淑霞
	,'18553376865'	// 史晓艳
	,'13793923480'	// 梁翠格
	,'18253908501'	// 王学安
	,'13791104336'	// 刘秀枝
	,'15168889958'	// 孔磊
	,'13376348285'	// 李雷
	,'13188888000'	// 赵泉霖
	,'15666326182'	// 王卫东
	,'13563043698'	// 曹怀敏
	,'13563915089'	// 李文侠
	,'18668987896'	// 张丽君
	,'13370582791'	// 付方明
	,'15092889280'	// 董庆玉
	,'15168889310'	// 王哲
	,'15318816220'	// 尹晓
	,'13853955790'	// 肖凤华
	,'13792964307'	// 王月丽
	,'13184119090'	// 董红
	,'18505333880'	// 于会文
	,'15863265769'	// 郭英
	,'15953152618'	// 牟淑敏
	,'13869692771'	// 张洁
	,'18678080529'	// 王玉霞
	,'18753509195'	// 金勇君
	,'15098201182'	// 陈进荣
	,'18653795766'	// 王增梅
	,'15666525182'	// 路巍
	,'13589607040'	// 王晓梅
	,'18560083987'	// 任建民
	,'15562216759'	// 冯爱萍
	,'15806300386'	// 刘向阳
	,'13696326976'	// 郝清顺
	,'13505468056'	// 赵连礼
	,'15206713020'	// 谭桂峰
	,'13954477369'	// 张淼
	,'13969906806'	// 徐方江
	,'15863159318'	// 涂相柏
	,'13608931936'	// 傅希灵
	,'15863615701'	// 付效国
	,'15315356691'	// 吕益奎
	,'18660639516'	// 明义
	,'15318816219'	// 王淑芳
	,'13869081995'	// 于京涛
	,'13792197907'	// 孙爱东
	,'13361257801'	// 于民民
	,'15505353339'	// 孟晓梅
	,'15254938831'	// 谷兴军
	,'18678186512'	// 赵晓东
	,'13863568298'	// 杜洪泉
	,'15064013055'	// 于汶津
	,'15192278999'	// 臧仁涛
	,'18663815237'	// 孙彩霞
	,'15864968658'	// 周东浩
	,'18678186510'	// 王淑娟
	,'13508944926'	// 岳建美
	,'13573764941'	// 钱光芳
	,'15666021567'	// 井庆平
	,'13791428449'	// 杨传梅
	,'18954106606'	// 李鹏
	,'13515328555'	// 王娜
	,'18606465209'	// 邱云霞
	,'18605468717'	// 刘红艳
	,'13053731032'	// 尤文君
	,'13562310066'	// 王继平
	,'13054693069'	// 陈新焰
	,'13306452889'	// 杜积慧
	,'18906306829'	// 王丽静
	,'18053123405'	// 白秀燕
	,'13963870509'	// 李春英
	,'13668652023'	// 邢春萍
	,'13563686637'	// 韩佳琳
	,'13061507560'	// 徐少全
	,'15966704850'	// 鹿丽
	,'18660865869'	// 郭征东
	,'13181088317'	// 闫向东
	,'13153105986'	// 赵淑淼
	,'13791122909'	// 侯为开
	,'13853951365'	// 王忠富
	,'15864920706'	// 苏旭东
	,'15563106009'	// 王朋波
	,'15910130281'	// 刘莹
	,'15589006602'	// 厉东亚
	,'13563230686'	// 王开芹
	,'13561547364'	// 李志刚
	,'13953440921'	// 徐天英
	,'13455374678'	// 邵明冉
	,'13583601019'	// 郭世彪
	,'13963610170'	// 程丽霞
	,'15589527155'	// 王思明
	,'13953472941'	// 张静
	,'18766866133'	// 张爱民
	,'13395468205'	// 赵桂东
	,'18953533512'	// 辛梅芳
	,'15168888303'	// 张海清
	,'15168889956'	// 韩文霞
	,'15168867396'	// 姜秀云
	,'13606370181'	// 薛建国
	,'18560083991'	// 董明
	,'18560080308'	// 侯新国
	,'18769676333'	// 陈贵言
	,'13665399146'	// 彭焱
	,'13793182159'	// 唐宽晓
	,'18253691300'	// 梁金光
	,'18206565375'	// 乔宗星
	,'13905342798'	// 刘杰军
	,'18560083986'	// 陈福琴
	,'13853992916'	// 李云贵
	,'13562092103'	// 吴宇澄
	,'13905313208'	// 王彩玲
	,'15153169688'	// 倪一虹
	,'15153169691'	// 孙福敦
	,'13964039815'	// 孙爱丽
	,'18753158197'	// 陈诗鸿
	,'13065031818'	// 陈少华
	,'18953195331'	// 廖琳
	,'15066148361'	// 张军
	,'18953193585'	// 张伟
	,'15550005310'	// 张伟
	,'15866721705'	// 王焕君
	,'13305410718'	// 朱蕾
	,'15318816292'	// 逄曙光
	,'15168888705'	// 郭军
	,'15168889691'	// 张秀娟
	,'18554300961'	// 邱卫海
	,'18661807296'	// 贾兆通
	,'13563336878'	// 管仁莲
	,'13589221172'	// 金小桦
	,'18661805329'	// 高燕燕
	,'13573837993'	// 王海燕
	,'18653202962'	// 秦健
	,'13969888737'	// 李盈
	,'18653257100'	// 邹彦
	,'13305328196'	// 曲庚汝
	,'13708989906'	// 徐筱玮
	,'13396485668'	// 李光善
	,'13396485696'	// 白春英
	,'13963628270'	// 聂淑惠
	,'13081631123'	// 杨淑贞
	,'13791660086'	// 董月奎
	,'15966491026'	// 马彦
	,'13780932086'	// 迟志波
	,'13685356638'	// 赵立军
	,'18863491098'	// 唐正和
	,'13153839060'	// 周菁
	,'15318816218'	// 董晓林
	,'15318816221'	// 王少莲
	,'15589978023'	// 庄向华
	,'13405309111'	// 牛东升
	,'15168888303'	// 张海清
	,'15168889956'	// 韩文霞
	,'15168867396'	// 姜秀云
	,'13606370181'	// 薛建国
	,'18920070350'	// 张艳
	,'13602187593'	// 张优蕊
	,'15620062577'	// 宁书和
	,'18622431543'	// 张婷
	,'13920135637'	// 李凤英
	,'13512848750'	// 索艳
	,'13512026870'	// 蔡春沉
	,'13820167696'	// 袁捷
	,'13612029869'	// 曹俊英
	,'13516181650'	// 刘丽娜
	,'13022291644'	// 方秀梅
	,'15222501665'	// 刘冬梅
	,'18920232652'	// 王新
	,'13752737472'	// 王德满
	,'13602193266'	// 王金芳
	,'13820139218'	// 高玉梅
	,'13920628276'	// 崔洪臣
	,'13820332999'	// 徐秀华
	,'15122481737'	// 葛焕琦 
	//add li weichen 0931
	,'18554301318'	//山东省	- 于文
	//,'13583601019'	//山东省	- 郭世彪
	,'18953385266'	//山东省	- 徐艳华
	//,'18606465209'	//山东省	- 邱云霞
	//,'13395468205'	//山东省	- 赵桂东
	////,'13954905921'	//山东省	- 姚涤非
	//,'13864911058'	//山东省	- 刘淑霞
	,'13706375718'	//山东省	- 吴庆永
	//,'15589006602'	//山东省	- 厉东亚
	////,'13655391840'	//山东省	- 宋长虹
	////,'15563635869'	//山东省	- 徐希坤
	////,'15192835972'	//山东省	- 杜晓明
	////,'13869994518'	//山东省	- 马文杰
	,'15563002151'	//山东省	- 张志华
	////,'15020321043'	//山东省	- 曹怡玲
	//,'15254938831'	//山东省	- 谷兴军
	//,'13969906806'	//山东省	- 徐方江
	,'13723922588'	//山东省	- 赵红霞
	,'13563734748'	//山东省	- 杨中新
	,'13505439008'	//山东省	- 薛海波
	,'15506308728'	//山东省	- 王秀云
	,'13954666567'	//山东省	- 徐涛
	,'13181023588'	//山东省	- 魏锋
	////,'13562435328'	//山东省	- 赵秀伟
	,'18561728089'	//山东省	- 吴宁
	,'18561810903'	//山东省	- 孙靖
	,'18678989135'	//山东省	- 刘淑娟
	,'13869698986'	//山东省	- 刘海霞
	,'15866163986'	//山东省	- 周艳花
	,'15552201885'	//山东省	- 王丽娜
	////,'13705356829'	//山东省	- 刘建军
	,'15666303077'	//山东省	- 于红岩
	//,'18766866133'	//山东省	- 张爱民
	////,'18953785706'	//山东省	- 王传中
	//,'15206713020'	//山东省	- 谭桂峰
	,'15966110266'	//山东省	- 高明殿
	,'13583024170'	//山东省	- 高志英
	,'13176120868'	//山东省	- 牛永国
	//,'18660865869'	//山东省	- 郭征东
	,'13563771686'	//山东省	- 黄显丰
	,'15265722112'	//山东省	- 陈翠芝
	,'15153169790'	//山东省	- 刘元涛
	//,'13053731032'	//山东省	- 尤文君
	////,'13405309111'	//山东省	- 牛东升
	,'15621043130'	//山东省	- 毛军
	,'17072872826'	//山东省	- 陈桂芝
	,'18553135690'	//山东省	- 王东
	////,'13869996056'	//山东省	- 黄秋静
	,'15153996197'	//山东省	- 朱洁
	,'13561108096'	//山东省	- 庞德水
	,'15953917377'	//山东省	- 宋仪利
	,'13869900778'	//山东省	- 高冠起
	,'13561196726'	//山东省	- 王德忠
);


$config['dirty_words'] = array(
	'日你妈',
	'呆逼',
	'傻逼',
	'狗屎',
	'操你妈',
	'滚蛋',
	'共产党',
	'狗日的'
);

/*
|--------------------------------------------------------------------------
| Index File
|--------------------------------------------------------------------------
|
| Typically this will be your index.php file, unless you've renamed it to
| something else. If you are using mod_rewrite to remove the page set this
| variable so that it is blank.
|
*/
$config['index_page'] = '';

/*
|--------------------------------------------------------------------------
| URI PROTOCOL
|--------------------------------------------------------------------------
|
| This item determines which server global should be used to retrieve the
| URI string.  The default setting of 'REQUEST_URI' works for most servers.
| If your links do not seem to work, try one of the other delicious flavors:
|
| 'REQUEST_URI'    Uses $_SERVER['REQUEST_URI']
| 'QUERY_STRING'   Uses $_SERVER['QUERY_STRING']
| 'PATH_INFO'      Uses $_SERVER['PATH_INFO']
|
| WARNING: If you set this to 'PATH_INFO', URIs will always be URL-decoded!
*/
$config['uri_protocol']	= 'REQUEST_URI';

/*
|--------------------------------------------------------------------------
| URL suffix
|--------------------------------------------------------------------------
|
| This option allows you to add a suffix to all URLs generated by CodeIgniter.
| For more information please see the user guide:
|
| http://codeigniter.com/user_guide/general/urls.html
*/

$config['url_suffix'] = '';

/*
|--------------------------------------------------------------------------
| Default Language
|--------------------------------------------------------------------------
|
| This determines which set of language files should be used. Make sure
| there is an available translation if you intend to use something other
| than english.
|
*/
$config['language']	= 'english';

/*
|--------------------------------------------------------------------------
| Default Character Set
|--------------------------------------------------------------------------
|
| This determines which character set is used by default in various methods
| that require a character set to be provided.
|
| See http://php.net/htmlspecialchars for a list of supported charsets.
|
*/
$config['charset'] = 'UTF-8';

/*
|--------------------------------------------------------------------------
| Enable/Disable System Hooks
|--------------------------------------------------------------------------
|
| If you would like to use the 'hooks' feature you must enable it by
| setting this variable to TRUE (boolean).  See the user guide for details.
|
*/
$config['enable_hooks'] = FALSE;

/*
|--------------------------------------------------------------------------
| Class Extension Prefix
|--------------------------------------------------------------------------
|
| This item allows you to set the filename/classname prefix when extending
| native libraries.  For more information please see the user guide:
|
| http://codeigniter.com/user_guide/general/core_classes.html
| http://codeigniter.com/user_guide/general/creating_libraries.html
|
*/
$config['subclass_prefix'] = 'NN_';

/*
|--------------------------------------------------------------------------
| Composer auto-loading
|--------------------------------------------------------------------------
|
| Enabling this setting will tell CodeIgniter to look for a Composer
| package auto-loader script in application/vendor/autoload.php.
|
|	$config['composer_autoload'] = TRUE;
|
| Or if you have your vendor/ directory located somewhere else, you
| can opt to set a specific path as well:
|
|	$config['composer_autoload'] = '/path/to/vendor/autoload.php';
|
| For more information about Composer, please visit http://getcomposer.org/
|
| Note: This will NOT disable or override the CodeIgniter-specific
|	autoloading (application/config/autoload.php)
*/
$config['composer_autoload'] = FALSE;

/*
|--------------------------------------------------------------------------
| Allowed URL Characters
|--------------------------------------------------------------------------
|
| This lets you specify which characters are permitted within your URLs.
| When someone tries to submit a URL with disallowed characters they will
| get a warning message.
|
| As a security measure you are STRONGLY encouraged to restrict URLs to
| as few characters as possible.  By default only these are allowed: a-z 0-9~%.:_-
|
| Leave blank to allow all characters -- but only if you are insane.
|
| The configured value is actually a regular expression character group
| and it will be executed as: ! preg_match('/^[<permitted_uri_chars>]+$/i
|
| DO NOT CHANGE THIS UNLESS YOU FULLY UNDERSTAND THE REPERCUSSIONS!!
|
*/
$config['permitted_uri_chars'] = 'a-z 0-9~%.:_\-';


/*
|--------------------------------------------------------------------------
| Enable Query Strings
|--------------------------------------------------------------------------
|
| By default CodeIgniter uses search-engine friendly segment based URLs:
| example.com/who/what/where/
|
| By default CodeIgniter enables access to the $_GET array.  If for some
| reason you would like to disable it, set 'allow_get_array' to FALSE.
|
| You can optionally enable standard query string based URLs:
| example.com?who=me&what=something&where=here
|
| Options are: TRUE or FALSE (boolean)
|
| The other items let you set the query string 'words' that will
| invoke your controllers and its functions:
| example.com/index.php?c=controller&m=function
|
| Please note that some of the helpers won't work as expected when
| this feature is enabled, since CodeIgniter is designed primarily to
| use segment based URLs.
|
*/
$config['allow_get_array'] = TRUE;
$config['enable_query_strings'] = FALSE;
$config['controller_trigger'] = 'c';
$config['function_trigger'] = 'm';
$config['directory_trigger'] = 'd';

/*
|--------------------------------------------------------------------------
| Error Logging Threshold
|--------------------------------------------------------------------------
|
| If you have enabled error logging, you can set an error threshold to
| determine what gets logged. Threshold options are:
| You can enable error logging by setting a threshold over zero. The
| threshold determines what gets logged. Threshold options are:
|
|	0 = Disables logging, Error logging TURNED OFF
|	1 = Error Messages (including PHP errors)
|	2 = Debug Messages
|	3 = Informational Messages
|	4 = All Messages
|
| You can also pass an array with threshold levels to show individual error types
|
| 	array(2) = Debug Messages, without Error Messages
|
| For a live site you'll usually only enable Errors (1) to be logged otherwise
| your log files will fill up very fast.
|
*/
$config['log_threshold'] = 0;

/*
|--------------------------------------------------------------------------
| Error Logging Directory Path
|--------------------------------------------------------------------------
|
| Leave this BLANK unless you would like to set something other than the default
| application/logs/ directory. Use a full server path with trailing slash.
|
*/
$config['log_path'] = '';

/*
|--------------------------------------------------------------------------
| Log File Extension
|--------------------------------------------------------------------------
|
| The default filename extension for log files. The default 'php' allows for
| protecting the log files via basic scripting, when they are to be stored
| under a publicly accessible directory.
|
| Note: Leaving it blank will default to 'php'.
|
*/
$config['log_file_extension'] = '';

/*
|--------------------------------------------------------------------------
| Log File Permissions
|--------------------------------------------------------------------------
|
| The file system permissions to be applied on newly created log files.
|
| IMPORTANT: This MUST be an integer (no quotes) and you MUST use octal
|            integer notation (i.e. 0700, 0644, etc.)
*/
$config['log_file_permissions'] = 0644;

/*
|--------------------------------------------------------------------------
| Date Format for Logs
|--------------------------------------------------------------------------
|
| Each item that is logged has an associated date. You can use PHP date
| codes to set your own date formatting
|
*/
$config['log_date_format'] = 'Y-m-d H:i:s';

/*
|--------------------------------------------------------------------------
| Error Views Directory Path
|--------------------------------------------------------------------------
|
| Leave this BLANK unless you would like to set something other than the default
| application/views/errors/ directory.  Use a full server path with trailing slash.
|
*/
$config['error_views_path'] = '';

/*
|--------------------------------------------------------------------------
| Cache Directory Path
|--------------------------------------------------------------------------
|
| Leave this BLANK unless you would like to set something other than the default
| application/cache/ directory.  Use a full server path with trailing slash.
|
*/
$config['cache_path'] = '';

/*
|--------------------------------------------------------------------------
| Cache Include Query String
|--------------------------------------------------------------------------
|
| Set this to TRUE if you want to use different cache files depending on the
| URL query string.  Please be aware this might result in numerous cache files.
|
*/
$config['cache_query_string'] = FALSE;

/*
|--------------------------------------------------------------------------
| Encryption Key
|--------------------------------------------------------------------------
|
| If you use the Encryption class, you must set an encryption key.
| See the user guide for more info.
|
| http://codeigniter.com/user_guide/libraries/encryption.html
|
*/
$config['encryption_key'] = '';

/*
|--------------------------------------------------------------------------
| Session Variables
|--------------------------------------------------------------------------
|
| 'sess_driver'
|
|	The storage driver to use: files, database, redis, memcached
|
| 'sess_cookie_name'
|
|	The session cookie name, must contain only [0-9a-z_-] characters
|
| 'sess_expiration'
|
|	The number of SECONDS you want the session to last.
|	Setting to 0 (zero) means expire when the browser is closed.
|
| 'sess_save_path'
|
|	The location to save sessions to, driver dependant.
|
|	For the 'files' driver, it's a path to a writable directory.
|	WARNING: Only absolute paths are supported!
|
|	For the 'database' driver, it's a table name.
|	Please read up the manual for the format with other session drivers.
|
|	IMPORTANT: You are REQUIRED to set a valid save path!
|
| 'sess_match_ip'
|
|	Whether to match the user's IP address when reading the session data.
|
| 'sess_time_to_update'
|
|	How many seconds between CI regenerating the session ID.
|
| 'sess_regenerate_destroy'
|
|	Whether to destroy session data associated with the old session ID
|	when auto-regenerating the session ID. When set to FALSE, the data
|	will be later deleted by the garbage collector.
|
| Other session cookie settings are shared with the rest of the application,
| except for 'cookie_prefix' and 'cookie_httponly', which are ignored here.
|
*/
$config['sess_driver'] = 'files';
$config['sess_cookie_name'] = 'ci_session';
$config['sess_expiration'] = 7200;
$config['sess_save_path'] = NULL;
$config['sess_match_ip'] = FALSE;
$config['sess_time_to_update'] = 300;
$config['sess_regenerate_destroy'] = FALSE;

/*
|--------------------------------------------------------------------------
| Cookie Related Variables
|--------------------------------------------------------------------------
|
| 'cookie_prefix'   = Set a cookie name prefix if you need to avoid collisions
| 'cookie_domain'   = Set to .your-domain.com for site-wide cookies
| 'cookie_path'     = Typically will be a forward slash
| 'cookie_secure'   = Cookie will only be set if a secure HTTPS connection exists.
| 'cookie_httponly' = Cookie will only be accessible via HTTP(S) (no javascript)
|
| Note: These settings (with the exception of 'cookie_prefix' and
|       'cookie_httponly') will also affect sessions.
|
*/
$config['cookie_prefix']	= '';
$config['cookie_domain']	= '.diabetes.com.cn';
$config['cookie_path']		= '/';
$config['cookie_secure']	= FALSE;
$config['cookie_httponly'] 	= FALSE;

/*
|--------------------------------------------------------------------------
| Standardize newlines
|--------------------------------------------------------------------------
|
| Determines whether to standardize newline characters in input data,
| meaning to replace \r\n, \r, \n occurences with the PHP_EOL value.
|
| This is particularly useful for portability between UNIX-based OSes,
| (usually \n) and Windows (\r\n).
|
*/
$config['standardize_newlines'] = FALSE;

/*
|--------------------------------------------------------------------------
| Global XSS Filtering
|--------------------------------------------------------------------------
|
| Determines whether the XSS filter is always active when GET, POST or
| COOKIE data is encountered
|
| WARNING: This feature is DEPRECATED and currently available only
|          for backwards compatibility purposes!
|
*/
// $config['global_xss_filtering'] = FALSE;
$config['global_xss_filtering'] = TRUE;

/*
|--------------------------------------------------------------------------
| Cross Site Request Forgery
|--------------------------------------------------------------------------
| Enables a CSRF cookie token to be set. When set to TRUE, token will be
| checked on a submitted form. If you are accepting user data, it is strongly
| recommended CSRF protection be enabled.
|
| 'csrf_token_name' = The token name
| 'csrf_cookie_name' = The cookie name
| 'csrf_expire' = The number in seconds the token should expire.
| 'csrf_regenerate' = Regenerate token on every submission
| 'csrf_exclude_uris' = Array of URIs which ignore CSRF checks
*/
$config['csrf_protection'] = FALSE;
$config['csrf_token_name'] = 'csrf_my_name';
$config['csrf_cookie_name'] = 'csrf_my_name';
$config['csrf_expire'] = 7200;
$config['csrf_regenerate'] = TRUE;
$config['csrf_exclude_uris'] = array();

/*
|--------------------------------------------------------------------------
| Output Compression
|--------------------------------------------------------------------------
|
| Enables Gzip output compression for faster page loads.  When enabled,
| the output class will test whether your server supports Gzip.
| Even if it does, however, not all browsers support compression
| so enable only if you are reasonably sure your visitors can handle it.
|
| Only used if zlib.output_compression is turned off in your php.ini.
| Please do not use it together with httpd-level output compression.
|
| VERY IMPORTANT:  If you are getting a blank page when compression is enabled it
| means you are prematurely outputting something to your browser. It could
| even be a line of whitespace at the end of one of your scripts.  For
| compression to work, nothing can be sent before the output buffer is called
| by the output class.  Do not 'echo' any values with compression enabled.
|
*/
$config['compress_output'] = FALSE;

/*
|--------------------------------------------------------------------------
| Master Time Reference
|--------------------------------------------------------------------------
|
| Options are 'local' or any PHP supported timezone. This preference tells
| the system whether to use your server's local time as the master 'now'
| reference, or convert it to the configured one timezone. See the 'date
| helper' page of the user guide for information regarding date handling.
|
*/
$config['time_reference'] = 'local';

/*
|--------------------------------------------------------------------------
| Rewrite PHP Short Tags
|--------------------------------------------------------------------------
|
| If your PHP installation does not have short tag support enabled CI
| can rewrite the tags on-the-fly, enabling you to utilize that syntax
| in your view files.  Options are TRUE or FALSE (boolean)
|
*/
$config['rewrite_short_tags'] = FALSE;


/*
|--------------------------------------------------------------------------
| Reverse Proxy IPs
|--------------------------------------------------------------------------
|
| If your server is behind a reverse proxy, you must whitelist the proxy
| IP addresses from which CodeIgniter should trust headers such as
| HTTP_X_FORWARDED_FOR and HTTP_CLIENT_IP in order to properly identify
| the visitor's IP address.
|
| You can use both an array or a comma-separated list of proxy addresses,
| as well as specifying whole subnets. Here are a few examples:
|
| Comma-separated:	'10.0.1.200,192.168.5.0/24'
| Array:		array('10.0.1.200', '192.168.5.0/24')
*/
$config['proxy_ips'] = '';
