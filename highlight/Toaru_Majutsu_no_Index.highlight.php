<?php

if (!defined('VALID_REQUEST')) die ('Access Denied.'); // Security

require_once(PATH_INCLUDE . 'highlight.inc.php');


// 人物一覧 https://ja.wikipedia.org/wiki/とある魔術の禁書目録の登場人物
// 巻別用語 http://www12.atwiki.jp/index-index/pages/1266.html
// 能力一覧 http://www12.atwiki.jp/index-index/pages/1577.html
// 魔法名   http://www12.atwiki.jp/index-index/pages/240.html
// 設定資料 http://r-s.sakura.ne.jp/w/i_m.htm

// http://toarumajutsunoindex.wikia.com/wiki/Toaru_Majutsu_no_Index_Wiki

function Highlight() {
	$items = array();

	return $items;
}

function Highlight_original() {
	$items = array();

	$items[] = new HighlightItem('魔法禁书目录', 'とある魔術の禁書目録', null);
	$items[] = new HighlightItem('魔法禁書目錄', 'とある魔術の禁書目録', null);

	ArrCharHighlightItem($items, '鎌池 和馬', ' ', null, '作者');
	$items[] = New_Highlight__Re('鎌池和馬', '鎌池和马', null, '作者');
	$items[] = New_Highlight__Re('鎌池和馬', '镰池和马', null, '作者');
	$items[] = New_Highlight__Re('鎌池',     '镰池',     null, '作者');
	$items[] = New_Highlight__Re(    '和馬', '/和马(?!上|车)/', null, '作者');

	ArrCharHighlightItem($items, '灰村 キヨタカ', ' ', null, '插画');
	$items[] = New_Highlight__Re('灰村キヨタカ', '灰村清孝', null, '插画');

	return $items;
}


function Highlight_comment() {
	$items = array();

	$items[] = new HighlightItem('薛定谔的猫',               null, '薛定谔的猫是奥地利物理学家埃尔温·薛定谔试图证明量子力学在宏观条件下的不完备性而提出的一个思想实验。');
	$items[] = New_Highlight__Re('薛定谔的猫', '薛丁格的猫', null, '薛定谔的猫是奥地利物理学家埃尔温·薛定谔试图证明量子力学在宏观条件下的不完备性而提出的一个思想实验。');
	$items[] = new HighlightItem('薛定谔',           '埃尔温·薛定谔 (Erwin Schrödinger)', '薛定谔(1887.08.12－1961.01.04)，又译薛丁格，生于维也纳埃德伯格(Wien Erdberg)，卒于维也纳。奥地利理论物理学家，量子力学的奠基人之一。1933年和英国物理学家狄拉克共同获得了诺贝尔物理学奖，被称为量子物理学之父。');
	$items[] = New_Highlight__Re('薛定谔', '薛丁格', '埃尔温·薛定谔 (Erwin Schrödinger)', '薛定谔(1887.08.12－1961.01.04)，又译薛丁格，生于维也纳埃德伯格(Wien Erdberg)，卒于维也纳。奥地利理论物理学家，量子力学的奠基人之一。1933年和英国物理学家狄拉克共同获得了诺贝尔物理学奖，被称为量子物理学之父。');
	$items[] = new HighlightItem('吉尼斯世界纪录',                 'Guinness World Records', null);
	$items[] = New_Highlight__Re('吉尼斯世界纪录', '金氏世界纪录', 'Guinness World Records', null);
	$items[] = new HighlightItem('护贝', null, '护贝胶膜');
	$items[] = new HighlightItem('发雕', 'Lotion', 'A lotion is a low- to medium-viscosity, topical preparation intended for consumption to unbroken skin; creams and gels.');
	$items[] = New_Highlight__Re('井盖', '人孔盖');
	$items[] = new HighlightItem('透天厝', null, '单栋独立住宅');
	$items[] = New_Highlight__Re('泵', '帮浦');

	return $items;
}

function Highlight_escape() {// sort, cat
	$items = array();

	$items[] = new HighlightItem('自相残杀（');//13

{// character
	$items[] = new HighlightItem('七一〇六八七号');//一〇六八七号
	$items[] = new HighlightItem('/华马场|赛马场/');//马场

	$items[] = new HighlightItem('/东南西北|南南西/');//南西
	$items[] = new HighlightItem('/麦克笔|麦克风/');//麦克

	$items[] = new HighlightItem('烈风');//风

	$items[] = new HighlightItem('彼得潘');//彼得
	$items[] = new HighlightItem('杀神之力');//神之力
}

{// ability
	$items[] = new HighlightItem('/绝大能力|强大能力/');//大能力
	$items[] = new HighlightItem('特异能力');//异能力

	$items[] = new HighlightItem('/火焰或闪电|火焰吸收氧气/');//发出火焰
	$items[] = new HighlightItem('构造比超电磁炮简单');//超电磁炮
	$items[] = new HighlightItem('/沿着死角|拍不到的死角/');//死角移动
	$items[] = new HighlightItem('引起原子崩坏');//原子崩坏
}

{// terminology
	//グループ
	$items[] = new HighlightItem('/「集团」(彻底甩开)|『集团』(是否能够回应神)|(目标)的「集团」|(这样一个|命题是)「集团」|(当地果然有|没有成功击溃|主旨是)『集团』|[「『]枪械[』」][跟和][「『]集团[』」]/');//集团
	//スクール
	$items[] = new HighlightItem('/所待的『学校』|「学校」(这个机能|就无法运作机能)/');//学校

	$items[] = new HighlightItem('警备员占领');//警备员


	$items[] = new HighlightItem('知道');//道教

	$items[] = new HighlightItem('/(巨大|四大)(?=天使)/');//大天使//13
	$items[] = new HighlightItem('/精神/');//神上//14
	$items[] = new HighlightItem('/圣人君子|神圣人物/');//圣人

	$items[] = new HighlightItem('毁灭全世界');//世界的力量//13

	$items[] = new HighlightItem('小魔法');//魔法
	$items[] = new HighlightItem('变魔术');//魔法//13
}

{// location
	$items[] = new HighlightItem('日本人');
	$items[] = new HighlightItem('英国人');
	$items[] = new HighlightItem('罗马人');
	$items[] = new HighlightItem('意大利人');
	$items[] = new HighlightItem('法国人');
	$items[] = new HighlightItem('俄罗斯人');
	$items[] = new HighlightItem('美国人');

	$items[] = new HighlightItem('教会那个');//教会
}

	return $items;
}


function Highlight_character_replace() {// sort, cat, jpn
	$items = array();

{// science
	//青髪 ピアス
	$items[] = New_Highlight__Re('蓝发耳环', '青发耳环');//16

	//打ち止め
	$items[] = New_Highlight__Re('最后之作', '/Last order(?!\)|）)/', '打ち止め(Last Order)', '御坂二〇〇〇一号');//13

	//アレイスター＝クロウリー（Aleister=Crowley）
	$items[] = New_Highlight__Re('亚雷斯塔·克劳利', '阿雷斯塔·库洛乌里');//13
	$items[] = New_Highlight__Re('亚雷斯塔', '阿雷斯塔');//13
	$items[] = New_Highlight__Re('克劳利',   '库洛乌里');//13
	$items[] = New_Highlight__Re('克劳利',   '克劳力');  //19
	//トマス＝プラチナバーグ
	$items[] = New_Highlight__Re('汤玛斯·普拉提纳柏格', '托马斯·普拉齐纳巴古');//13


	//ヒューズ＝カザキリ
	$items[] = New_Highlight__Re('保险丝—风斩', 'FUSE=KAZAKIRI', 'Fuse=KAZAKIRI', null);//13
	$items[] = New_Highlight__Re('保险丝—风斩', '修斯=风斩',     'Fuse=KAZAKIRI', null);//19
	$items[] = New_Highlight__Re('保险丝—风斩', '修斯·风斩',     'Fuse=KAZAKIRI', null);//20

	//エイワス
	$items[] = New_Highlight__Re('爱华斯', '艾华斯', 'Aiwass', null);//19

	//冥土帰し(ヘヴンキャンセラー)
	$items[] = New_Highlight__Re('冥土追魂', '冥土归还', '冥土帰し(Heaven Canceler)', null);//13
}

{// magic
	//禁書目録(インデックス)
	$items[] = New_Highlight__Re('茵蒂克丝', '茵缇克丝', 'Index-Librorum-Prohibitorum', '禁書目録');//13
	$items[] = New_Highlight__Re('茵蒂克丝', '/index(?![ -=][lL]|\.)(?:（禁书目录）)?/', 'Index-Librorum-Prohibitorum', '禁書目録');//14
	$items[] = New_Highlight__Re('茵蒂克丝', '茵蒂克斯', 'Index-Librorum-Prohibitorum', '禁書目録');//18

	//ステイル＝マグヌス（Stiyl=Magnus）
	$items[] = New_Highlight__Re('史提尔·马格努斯', '史提尔·玛格努姆');//17
	//神裂 火織
	$items[] = New_Highlight__Re('神裂火织', '神裂火炽');//16

	// ローラ＝スチュアート（Laura=Stuart）
	$items[] = New_Highlight__Re('萝拉·史都华', '罗拉·丝丘亚特');//16
	$items[] = New_Highlight__Re('萝拉·史都华', '萝拉·史都特');//17
	$items[] = New_Highlight__Re('萝拉·史都华', '萝拉·斯图尔特');//18
	$items[] = New_Highlight__Re('萝拉·史都华', '萝拉·斯图亚特');//20
	//オルソラ＝アクィナス（Orsola=Aquinas）
	$items[] = New_Highlight__Re('奥索拉·阿奎纳', '奥索拉·阿奎娜丝');//17
	$items[] = New_Highlight__Re('奥索拉·阿奎纳', '奥索拉·阿昆娜丝');//17
	$items[] = New_Highlight__Re('奥索拉', '欧露索拉');//14
	$items[] = New_Highlight__Re('奥索拉', '奥鲁索拉');//16

	//アニェーゼ＝サンクティス（Agnese=Sanctis）
	$items[] = New_Highlight__Re('雅妮丝·桑提斯', '亚捏赛·桑库缇丝');//14
	$items[] = New_Highlight__Re('雅妮丝·桑提斯', '雅妮丝·桑克迪斯');//17
	$items[] = New_Highlight__Re('雅妮丝·桑提斯', '亚涅赛·桑库缇丝');//18
	$items[] = New_Highlight__Re('雅妮丝', '亚捏赛');//14
	$items[] = New_Highlight__Re('雅妮丝', '亚涅赛');//18
	//アンジェレネ（Angelene）
	$items[] = New_Highlight__Re('安洁莉娜', '安洁雷妮');//17
	$items[] = New_Highlight__Re('安洁莉娜', '安琪蕾涅');//18

	//エリザード
	$items[] = New_Highlight__Re('伊莉莎', '艾莉莎德', null, '英国女王');//17
	$items[] = New_Highlight__Re('伊莉莎', '爱莉莎德', null, '英国女王');//18
	//リメエア
	$items[] = New_Highlight__Re('莉梅亚', '莉梅艾尔', null, '英国第一王女');//17
	$items[] = New_Highlight__Re('莉梅亚', '莉梅尔'  , null, '英国第一王女');//18
	//キャーリサ
	$items[] = New_Highlight__Re('凯莉莎', '琪雅莉莎', null, '英国第二王女');//17
	$items[] = New_Highlight__Re('凯莉莎', '琪雅丽莎', null, '英国第二王女');//18

	//リドヴィア＝ロレンツェッティ（Ridovia=Lorenzetti）
	$items[] = New_Highlight__Re('丽多薇雅·罗伦婕蒂', '丽多薇雅·萝莲洁蒂');//14
	$items[] = New_Highlight__Re('丽多薇雅·罗伦婕蒂', '莉德维亚·罗伦兹迪');//17
	//ビアージオ＝ブゾーニ（Biagio=Busoni）
	$items[] = New_Highlight__Re('彼亚吉欧·普索尼', '比亚吉欧·普索尼');//14
	$items[] = New_Highlight__Re('彼亚吉欧', '比亚吉欧');//14
	//ニコライ＝トルストイ
	$items[] = New_Highlight__Re('尼可拉·托尔斯泰', '尼克兰·托尔斯泰');//18
	$items[] = New_Highlight__Re('尼可拉', '尼克兰');//18

	//前方のヴェント
	$items[] = New_Highlight__Re('前方的风', '前方的Vent');//13
	$items[] = New_Highlight__Re(      '风',      '/Vent(?!\w)/');//13
	$items[] = New_Highlight__Re(      '风',       '乌安特');//14
	//後方のアックア / ウィリアム＝オルウェル
	$items[] = New_Highlight__Re('后方的水', '后方的Aqua(（水）)?');//13
	$items[] = New_Highlight__Re('后方的水', '后方的AQUA');//17
	$items[] = New_Highlight__Re(      '水',       'Aqua');//13
	$items[] = New_Highlight__Re(      '水',       'AQUA');//17
	$items[] = New_Highlight__Re('威廉·奥维尔', '威廉姆·奥鲁威鲁');//16
	$items[] = New_Highlight__Re('威廉',       '/威廉姆(?!·|一世)/');//16
	$items[] = New_Highlight__Re('威廉·奥维尔', '威廉·奥威尔');//18
	//左方のテッラ
	$items[] = New_Highlight__Re('后方的地', '左方的Terra');//13
	$items[] = New_Highlight__Re(      '地',       'Terra');//13
	//右方のフィアンマ
	$items[] = New_Highlight__Re('后方的火', '右方的Fiamma');//13
	$items[] = New_Highlight__Re(      '火',       'Fiamma');//16

	//ミーシャ＝クロイツェフ（Misha=Croitsef）
	$items[] = New_Highlight__Re('米夏·克洛伊洁芙', '米夏·库罗伊谢夫');//13
	$items[] = New_Highlight__Re('米夏·克洛伊洁芙', '米夏·库洛谢夫');//16

	//レッサー
	$items[] = New_Highlight__Re('蕾莎', '雷莎');//17
	//ベイロープ
	$items[] = New_Highlight__Re('贝洛璞', '贝萝普');//17
	$items[] = New_Highlight__Re('贝洛璞', '贝洛蒲');//20
	//フロリス
	$items[] = New_Highlight__Re('芙罗莉丝', '普罗莉丝');//17
	$items[] = New_Highlight__Re('芙罗莉丝', '普罗丽丝');//20
	//ランシス
	$items[] = New_Highlight__Re('兰西丝', '朗西丝');//17

	//エツァリ
	$items[] = New_Highlight__Re('艾扎力', '艾夏利');//15
	$items[] = New_Highlight__Re('艾扎力', '艾利夏');//19
	//ショチトル
	$items[] = New_Highlight__Re('索绮特', '肖奇托露');//15
	$items[] = New_Highlight__Re('索绮特', '修琪桃尔');//19

	//オリアナ＝トムソン（Oriana=Thomson）
	$items[] = New_Highlight__Re('欧莉安娜·汤森', '欧莉安娜·汤姆森');//14

	// その涙の理由を変える者(Flere210)
	$items[] = New_Highlight__Re('改变眼泪理由的人', '/改变那泪之理由者(?!）)(?:（Flere210）)?/', 'Flere210', null);//16
	$items[] = New_Highlight__Re('改变眼泪理由的人',   '/泪之因缘修改者(?!）)(?:（Flere210）)?/', 'Flere210', null);//18

	//神の如き者
	$items[] = New_Highlight__Re('似神者', '如神者', 'Michael', null);//17

}

	return $items;
}

function Highlight_character_translate() {// cat, jpn
	$items = array();

{// science
}

{// magic
	//テオドシア＝エレクトラ
	$items[] = new Highlight__Tr('特奥德西亚·厄勒克特拉');//18

	//後方のアックア / ウィリアム＝オルウェル
	$items[] = new Highlight__Tr('崩坏的恶者', '威廉·奥维尔', null);//18


	//ステファニー＝ゴージャスパレス
	$items[] = new Highlight__Tr('斯蒂芬妮·古杰斯帕蕾丝');//19
	$items[] = new Highlight__Tr('斯蒂芬妮');//19

	//エカリエーリャ＝A＝プロンスカヤ
	$items[] = new Highlight__Tr('艾卡莉艾莉亚·A·普伦斯卡亚');//20
	$items[] = new Highlight__Tr('艾卡莉艾莉亚');//20
	//ブラッシャ＝P＝マールハイスク
	$items[] = new Highlight__Tr('布兰夏·P·阿尔海因斯克皱着眉头');//20
	$items[] = new Highlight__Tr('布兰夏');//20
	//アンツェカ＝S＝クファルク
	$items[] = new Highlight__Tr('安杰卡·S·克法鲁');//20
	$items[] = new Highlight__Tr('安杰卡');//20

	$items[] = new Highlight__Tr('艾莉莎莉娜', '/艾莉莎莉娜(?!独立国同盟)/');//20
	//ディグルヴ
	$items[] = new Highlight__Tr('德格鲁');//20
	//グリッキン
	$items[] = new Highlight__Tr('格里金');//20

	//倾国之女
	$items[] = new Highlight__Tr('倾国之女');//20
}

	return $items;
}


function Highlight_character_science() { // sort, cat, jpn
	$items = array();

{// 主要キャラクター
	ArrCharHighlightItem($items, '上条 当麻');//上条 当麻
	$items[] = new HighlightItem('/天使上条|恶魔上条/');
	$items[] = new HighlightItem('阿上');//カミやん
	ArrCharHighlightItem($items, '御坂 美琴');//御坂 美琴
	$items[] = new HighlightItem('一方通行', '一方通行(Accelerator)', 'Level 5, No.1', '/一方通行(?:（Accelerator）)?/');
	ArrCharHighlightItem($items, '滨面 仕上');//浜面 仕上
	//妹達

	$items[] = new HighlightItem('放电妹', null, '御坂美琴');//ビリビリ//01
	$items[] = new HighlightItem('呆瓜三巨头', 'Delta Force', '上条、蓝发、土御门');//クラスの三バカ(デルタフォース)//12
	$items[] = new HighlightItem('笨蛋三巨头', null,          '上条、蓝发、土御门');//三馬鹿//14
}

{// 妹達
	//妹達
	$items[] = new HighlightItem('妹妹们', 'Sisters', null, '/妹妹们(?:（(?:SISTERS|Sisters)）)?/');
	$items[] = new HighlightItem('妹妹',   'Sisters', null, '/(?<=[「『])妹妹(?:（(?:SISTERS|Sisters)）)?(?=[』」])/');
	//ミサカ
	$items[] = new HighlightItem('/(御坂|编号|检体号码)?第?((一(?![〇零]{2}三二)|[〇零](?![〇零]{4}))[〇零一二三四五六七八九]{4}|二[〇零]{4}|(1(?!0032)|0(?!0000))[0123456789]{4}|20000)号/', '妹妹们（SISTERS）', '御坂$2号');
	//ミサカ一〇〇三二号/御坂妹
	$items[] = new HighlightItem('/(御坂|编号|检体号码)?第?(一〇〇三二|一零零三二|10032)号|御坂妹妹/', '御坂妹妹', '御坂一〇〇三二号');
	//ミサカ二〇〇〇一号/打ち止め/最終信号
	$items[] = new HighlightItem('/(御坂|编号|检体号码)?第?(二〇〇〇一|二零零零一|20001)号|御坂御坂(?!御坂|』|吧)/', '最后之作/最终信号 (Last Order)', '御坂二〇〇〇一号');
	//打ち止め
	$items[] = new HighlightItem('最后之作', '打ち止め(Last Order)',   '御坂二〇〇〇一号', '/最后之作(?:（Last Order）)?/');
	//最終信号
	$items[] = new HighlightItem('最终信号', '最終信号(Last Order)',   '御坂二〇〇〇一号', '/最终信号(?:（Last Order）)?/');
	//番外個体
	$items[] = new HighlightItem('番外个体', '番外個体(Misaka Worst)', '第三次制造计划新生御坂');
}

{// 上条の高校生徒
	//上条 当麻
	ArrCharHighlightItem($items, '土御门 元春');//土御門 元春
	$items[] = new HighlightItem('蓝发耳环');//青髪 ピアス
	ArrCharHighlightItem($items, '姬神 秋沙');//姫神 秋沙
	ArrCharHighlightItem($items, '吹寄 制理');//吹寄 制理
	ArrCharHighlightItem($items, '云川 芹亚');//雲川 芹亜
}

{// 上条の高校教師
	ArrCharHighlightItem($items, '月咏 小萌');//月詠 小萌
	$items[] = new HighlightItem('小萌老师');//小萌先生
	$items[] = new HighlightItem('小女孩老师', null, '学园七大不思议之一的小萌老师');//幼女先生
	$items[] = new HighlightItem('堆积如山的人体烟灰缸', 'White Smoker', '学园七大不思议之二的小萌老师');//山盛り灰皿(ホワイトスモーカー)

	ArrCharHighlightItem($items, '黄泉川 爱穗');//黄泉川 愛穂
	ArrCharHighlightItem($items, '亲船 素甘');//親船 素甘
	$items[] = new HighlightItem('/灾误(老师)?/');//災誤
}

{// 常盤台中学
	//御坂 美琴
	ArrCharHighlightItem($items, '白井 黑子');//白井 黒子
	ArrCharHighlightItem($items, '婚后 光子');//婚后 光子
	//食蜂 操祈
	$items[] = new HighlightItem('舍监');//寮監
}

{// スキルアウト(Skill Out)
	ArrCharHighlightItem($items, '驹场 利德');//駒場 利徳
	ArrCharHighlightItem($items, '服部 半藏');//服部 半蔵
	//横須賀
}

{// その他の学生
	ArrCharHighlightItem($items, '土御门 舞夏');//土御門 舞夏
	//海原 光貴
	//エリス
	ArrCharHighlightItem($items, '初春 饰利');//初春 飾利
	ArrCharHighlightItem($items, '削板 军霸');//削板 軍覇
	//原谷 矢文
	//工山 規範
	//フレメア＝セイヴェルン
	//雲川 鞠亜
	//微細 乙愛
}

{// 警備員
	//黄泉川 愛穂
	ArrCharHighlightItem($items, '才乡 良太');//才郷 良太
	ArrCharHighlightItem($items, '杉山 枝雄');//杉山 枝雄
	//亀山 琉太
	//麓洞 龍一
	//手塩 恵未
	//工示 雅影
}

{// 統括理事会
	ArrCharHighlightItem($items, '亚雷斯塔·克劳利', '·');//アレイスター＝クロウリー（Aleister=Crowley）
	$items[] = new HighlightItem('爱德华·亚历山大');//ワード＝アレクサンダ//14

	ArrCharHighlightItem($items, '亲船 最中');//親船 最中
	ArrCharHighlightItem($items, '贝积 继敏');//貝積 継敏
	$items[] = new HighlightItem('潮岸');//潮岸
	$items[] = new HighlightItem('汤玛斯·普拉提纳柏格');//トマス＝プラチナバーグ
}

{// ドラゴン(Dragon)
	ArrCharHighlightItem($items, '风斩 冰华');//風斬 氷華
	$items[] = new HighlightItem('保险丝风斩',  'Fuse=KAZAKIRI', null);//ヒューズ＝カザキリ//12(1)
	$items[] = new HighlightItem('保险丝—风斩', 'Fuse=KAZAKIRI', null);//ヒューズ＝カザキリ//13(2)

	$items[] = new HighlightItem('爱华斯', 'Aiwass', null, '/爱华斯(?:（(?:爱华斯＝)?Aiwass）)?/');//エイワス
}

{// 暗部 猟犬部隊
	$items[] = new HighlightItem('/木原数多|木原/');//木原 数多
	$items[] = new HighlightItem('奥森');///オーソン
	$items[] = new HighlightItem('洛德');///ロッド
	$items[] = new HighlightItem('南西');//ナンシー
	$items[] = new HighlightItem('薇拉');//ヴェーラ
	$items[] = new HighlightItem('麦克');//マイク
	$items[] = new HighlightItem('丹尼斯');//デニス
}

{// 暗部 グループ(Group)
	//土御門 元春
	//一方通行
	ArrCharHighlightItem($items, '海原 光贵');//海原 光貴
	ArrCharHighlightItem($items, '结标 淡希');//結標 淡希
	//グループの連絡係

	$items[] = new HighlightItem('带路人', null, '结标淡希');//案内人
}

{// 暗部 スクール(School)
	ArrCharHighlightItem($items, '垣根 帝督');//垣根 帝督
	//心理定規
	//ゴーグルの少年
	//砂皿 緻密
	ArrCharHighlightItem($items, '砂皿 致密');//砂皿 緻密//15
}

{// 暗部 アイテム(Item)
	ArrCharHighlightItem($items, '麦野 沉利');//麦野 沈利
	ArrCharHighlightItem($items, '绢旗 最爱');//絹旗 最愛
	$items[] = new HighlightItem('芙兰达');//フレンダ＝セイヴェルン
	ArrCharHighlightItem($items, '泷壶 理后');//滝壺 理后
	//浜面 仕上
	//電話の女
}

{// 暗部 メンバー(Member)
	//博士
	ArrCharHighlightItem($items, '马场 芳郎');//馬場 芳郎
	$items[] = new HighlightItem('查乐');//査楽
	//ショチトル
}

{// 暗部 ブロック(Block)
	ArrCharHighlightItem($items, '佐久 辰彦');//佐久 辰彦
	ArrCharHighlightItem($items, '手盐 惠未');//手塩 恵未
	$items[] = new HighlightItem('山手');//山手
	$items[] = new HighlightItem('铁网', '/铁网(?=的(手|少女|表情)|伸手|压住|似乎|握手|轻轻摇头)|(?<=「)铁网(?=……)|(?<=走到)铁网(?=前)/');//鉄網//15
}

{// 暗部 新入生
	//黒夜 海鳥
	//シルバークロース＝アルファ
}

{// その他の関係者
	$items[] = new HighlightItem('冥土追魂', '冥土帰し(Heaven Canceler)', null);//冥土帰し(ヘヴンキャンセラー)
	$items[] = new HighlightItem('青蛙脸医生',   null, '冥土追魂');//カエル顔の医者
	$items[] = new HighlightItem('青蛙脸的医生', null, '冥土追魂');//カエル顔の医者

	ArrCharHighlightItem($items, '芳川 桔梗');//芳川 桔梗
	ArrCharHighlightItem($items, '天井 亚雄');//天井 亜雄
	$items[] = new HighlightItem('杉谷');//杉谷
	//丈澤 道彦


	$items[] = new HighlightItem('人才派遣', 'Management', null);//人材派遣(マネジメント)//14
}

	return $items;
}

function Highlight_character_magic() { // sort, cat, jpn
	$items = array();

{// 主要キャラクター
	// 禁書目録(インデックス)
	$items[] = new HighlightItem('茵蒂克丝', 'Index-Librorum-Prohibitorum', '禁书目录', '/茵蒂克丝(?:（INDEX）)?/');
	$items[] = new HighlightItem('禁书目录', 'Index-Librorum-Prohibitorum', null);
	$items[] = new HighlightItem('魔道书图书馆', null, '禁书目录');
	$items[] = new HighlightItem('/Index([ -=])Librorum\g{-1}Prohibitorum/', null, '禁书目录');
}

{// 英国 イギリス清教
	//インデックス（Index）
	ArrCharHighlightItem($items, '史提尔·马格努斯', '·');//ステイル＝マグヌス（Stiyl=Magnus）
	ArrCharHighlightItem($items, '神裂 火织');//神裂 火織
	//土御門 元春
	ArrCharHighlightItem($items, '雪莉·克伦威尔', '·');
	ArrCharHighlightItem($items, '萝拉·史都华', '·');//ローラ＝スチュアート（Laura=Stuart）
	ArrCharHighlightItem($items, '劳拉·史都华', '·');//ローラ＝スチュアート（Laura=Stuart）//16
	ArrCharHighlightItem($items, '奥索拉·阿奎纳', '·');//オルソラ＝アクィナス（Orsola=Aquinas）
	//テオドシア＝エレクトラ
	//リチャード＝ブレイブ
}

{// 英国 イギリス清教 天草式十字凄教
	//神裂 火織
	ArrCharHighlightItem($items, '建宫 斋字');//建宮 斎字
	$items[] = new HighlightItem('五和');//五和
	$items[] = new HighlightItem('浦上');//浦上
	$items[] = new HighlightItem('牛深');//牛深
	$items[] = new HighlightItem('香烧');//香焼
	$items[] = new HighlightItem('谏早');//諫早
	$items[] = new HighlightItem('野母崎');//野母崎
	$items[] = new HighlightItem('对马');//対馬
}

{// 英国 イギリス清教 アニェーゼ部隊
	ArrCharHighlightItem($items, '雅妮丝·桑提斯', '·');//アニェーゼ＝サンクティス（Agnese=Sanctis）
	$items[] = new HighlightItem('露琪亚');//ルチア（Lucia）
	$items[] = new HighlightItem('安洁莉娜');//アンジェレネ（Angelene）
	$items[] = new HighlightItem('阿嘉妲');//アガター
	$items[] = new HighlightItem('凯特琳娜');//カテリナ
}

{// 英国 イギリス清教 協力者
	ArrCharHighlightItem($items, '查尔斯·康德', '·');//チャールズ＝コンダー
	$items[] = new HighlightItem('史玛维丽');//スマートヴェリー
}

{// 英国 王室派
	$items[] = new HighlightItem('伊莉莎', null, '英国女王');//エリザード//17
	$items[] = new HighlightItem('莉梅亚', null, '英国第一王女');//リメエア//17
	$items[] = new HighlightItem('凯莉莎', null, '英国第二王女');//キャーリサ//17
	$items[] = new HighlightItem('薇莉安', null, '英国第三王女');//ヴィリアン//17
	$items[] = new HighlightItem('席薇亚', null, '近卫侍女(圣人)');//シルビア//17
}

{// 英国 騎士派
	$items[] = new HighlightItem('骑士团长', 'Knight Leader', null);//騎士団長（ナイトリーダー）
}

{// ローマ正教
	$items[] = new HighlightItem('罗马教皇');//マタイ＝リース//21

	//リドヴィア＝ロレンツェッティ（Ridovia=Lorenzetti）
	ArrCharHighlightItem($items, '丽多薇雅·罗伦婕蒂', '·');
	//告解の火曜(マルディグラ)
	$items[] = new HighlightItem('告解星期二',   'Mardi Gras', '丽多薇雅·罗伦婕蒂');//09(1)
	$items[] = new HighlightItem('告解的星期二', 'Mardi Gras', '丽多薇雅·罗伦婕蒂');//10(4)

	ArrCharHighlightItem($items, '彼亚吉欧·普索尼', '·');//ビアージオ＝ブゾーニ（Biagio=Busoni）//司教
	//ペテロ＝ヨグディス//枢機卿
	//バルビナ
	$items[] = new HighlightItem('帕西法');//パルツィバル//02
	$items[] = new HighlightItem(                        '维多里欧·卡塞拉');//ビットリオ＝カゼラ//02
	$items[] = new HighlightItem('兰斯洛特', 'Lancelot', '维多里欧·卡塞拉');//ランスロット//02
}

{// ローマ正教 神の右
	//前方のヴェント
	$items[] = new HighlightItem('前方之风', 'Vent', null);//14
/*	$items[] = new HighlightItem('风', 'Vent', '前方之风', '/(?<=[「『])风(?=(!!)?[』」])' .
		'|(?<=被)风(?=杀害|说什么)|(?<=靠|让)风(?=来?先攻)|(?<=叫)风(?=的)|(?<=以)风(?=为中心)|(?<=跟)风(?=一样|完全被|同等级|两人转头)|(?<=因为)风(?=让)|(?<=穿过)风(?=跟)|(?<=放任)风(?=不管)' .
		'|(?<=当然)风(?=不可能)|(?<=但)风(?=那边|看起来|的确是|根本不可能)|(?<=正当)风(?=要)' .
		'|(?<=包围着)风(?=一般)|(?<=自称是)风(?=的)|(?<=看不到)风(?=之后)|(?<=出自于)风(?=特有)|(?<=注视着)风(?=说道)' .
		'|(?<=阻止|打赢|离开|放开)风(?!斩)|(?<=束缚住)风(?!斩)|(?<=正面盯着)风(?!斩)' .
		'|(?<=(愉快|现在|倒地)的)风(?!斩)' .
		'|(?<=(腋下)的)风(?!斩)' .
		'|(?<=(目标逃走|突破大门|失去平衡|配合靠近|流着鲜血|有主导权|最大一击|浑身无力|单手抱着)的)风(?!斩)' .
		'|风(?=呢|用|只能|看着|就是|发出|也许|回应|几乎|舌头|口中|站立|走在|靠在|位于|虽然|擦拭|皱起|脸上|转过|只是|已经|所看|嘲笑|单手|逃跑|挥动|吸进|穿过|手中|手里|心里|右手|腹部|大叫|手腕|朝着|吐出|两手|大吼|对着|自己|选择|现在|眼睛|移向|决定|双手|回来)' .
		'|风(?=在口中|轻松地|朝那里|没有从|大大地|慢慢地笑着|愉快地|将卷着|将槌子|将双手|将扛在|并没有|是为了|摇晃着|也曾经|瞄偏了|应该会|想挥动|会这么)' .
		'|风(?=随意挥动|掠过锁链|却实现了|就在眼前|所放出的|破口大骂|一直避免|横向挥动|突然身体|胡乱挥动|屏住气息|接二连三|会怎么样|是突发性|这么痛苦|抱在腋下|表现恶意|由我回收)' .
		'|风(?=会脸色大变|或黑衣男子|刺耳的声音|满脸通红地|杂乱的攻击|不只是这样|一直在自责|就无法使用|被打败了|一副毫不在乎|叮叮当当地摇晃着)' .
		'|风(?=的(话|脸|实力|表情|舌头|眼里|右手|耳朵|目标|身上|存在|诡计|嘴边|面前|身体|槌子|凶器|怀里|语意|鼻梁|黑暗|灵装|性质|不明攻击|天谴术式|主要攻击|所作所为|行动理由))' .
		'|风(?=的攻击(?!』))|(?<=(受到|弹开|读取))风(?=的攻击)' .
		'|(?<=在他出手之前)风(?=突然转换方向)' .
		'/');//风//13*/
	//後方のアックア / ウィリアム＝オルウェル
	$items[] = new HighlightItem('后方之水', 'Aqua', null);//13
/*	$items[] = new HighlightItem('水', 'Aqua', '后方之水', '/(?<=[「『])水(?=[』」])' .
		'|(?<=跟)水(?=面对面)' .
		'|(?<=，)水(?=？|跟{{\d+}})|(?<=<p>)水(?=将{{\d+}})' .
		'|水(?=说道|挂断|拿起|看起来|沉默了|一脸漠然|吐了口气|说出的话|发出郁闷|因为雨伞|重新抱好|一副厌腻|淡淡地笑了|却丝毫不理|微微吐了口气)' .
		'|水(?=的(笑意|视线))' .
		'/');//水//13*/
	//左方のテッラ16
	ArrCharHighlightItem($items, '威廉·奥维尔', '·');//後方のアックア / ウィリアム＝オルウェル//16
	$items[] = new HighlightItem('左方之地', 'Terra', null);//13
/*	$items[] = new HighlightItem('地', 'Terra', '左方之地', '/(?<=[「『])地(?=[』」])' .
		'|(?<=是)地(?=吗)' .
		'/');//地//13*/
	//右方のフィアンマ
	$items[] = new HighlightItem('右方之火', 'Fiamma', null);//14
}

{// ロシア成教
	ArrCharHighlightItem($items, '莎夏·克洛伊洁芙', '·');//サーシャ＝クロイツェフ（Sasha=Croitsef）
	ArrCharHighlightItem($items, '米夏·克洛伊洁芙', '·');//ミーシャ＝クロイツェフ（Misha=Croitsef）
	$items[] = new HighlightItem('瓦希莉莎');//ワシリーサ（Vasilissa）
	ArrCharHighlightItem($items, '尼可拉·托尔斯泰', '·');//ニコライ＝トルストイ
	//クランス＝R＝ツァールスキー
	//スクーグズヌフラ
	//ブラッシャ＝P＝マールハイスク
	//ヴォジャノーイ
}

{// 新たなる光 translate
	$items[] = new HighlightItem('蕾莎');//レッサー//17
	$items[] = new HighlightItem('贝洛璞');//ベイロープ//17
	$items[] = new HighlightItem('芙罗莉丝');//フロリス//17
	$items[] = new HighlightItem('兰西丝');//ランシス//17
}

{// 明け色の陽射し
	//レイヴィニア＝バードウェイ
	//マーク＝スペース
}

{// 翼ある者の帰還 translate
	$items[] = new HighlightItem('艾扎力');//エツァリ//15
	$items[] = new HighlightItem('索绮特');//ショチトル//15
	//トチトリ
	$items[] = new Highlight__Tr('托琪托莉');//19
	//テクパトル
	$items[] = new Highlight__Tr('提库帕托鲁');//19
}

{// グレムリン
}

{// 他の組織 無所属
	ArrCharHighlightItem($items, '奥雷欧斯·伊萨德', '·');//アウレオルス＝イザード（Aureolus=Izzard）
	ArrCharHighlightItem($items, '闇咲 逢魔');//闇咲 逢魔

	//オリアナ＝トムソン（Oriana=Thomson）
	ArrCharHighlightItem($items, '欧莉安娜·汤森', '·');
	//追跡封じ(ルートディスターブ)
	$items[] = new HighlightItem('追踪封锁', 'Route Disturb', '欧莉安娜·汤森');

	//オッレルス
	//エリザリーナ
	//傾国の女
	//ブリュンヒルド＝エイクトベル
	//セイリエ＝フラットリー
}

{// 魔法名
	// 献身的な子羊は強者の知識を守る(Dedicatus545)
	$items[] = new HighlightItem('Dedicatus545', '献身的羔羊守护强者的知识', null);

	// 我が名が最強である理由をここに証明する(Fortis931)
	$items[] = new HighlightItem('Fortis931', '在此证明我乃最强之理由', null, '/Fortis931(?!）)(?:（在此证明我名为最强之理由）)?/');
	$items[] = new HighlightItem('在此证明我乃最强之理由', 'Fortis931', null, '/在此证明我乃最强之理由(?!）)(?:（Fortis931）)?/');

	// 救われぬ者に救いの手を(Salvare000/Salvere000)
	$items[] = new HighlightItem('Salvare000', '受遗弃者的救赎之手<del>（一卷）</del>', null, '/Salvare000(?!）)(?:（受遗弃者的救赎之手）)?/');//01
	$items[] = new HighlightItem('Salvere000', '受遗弃者的救赎之手<del>（四卷）</del>', null, '/Salvere000(?!）)(?:（受遗弃者的救赎之手）)?/');//04

	// 我が名誉は世界のために(Honos628)
	$items[] = new HighlightItem('Honos628', '我的名誉，为了世界而存在', null, '/Honos628(?!）)(?:（我的名誉，为了世界而存在）)?/');

	// 我が名誉は世界のために(Fallere825)
	$items[] = new HighlightItem('Fallere825', '背后捅人刀', null, '/Fallere825(?!）)(?:（背后捅人刀）)?/');
	$items[] = new HighlightItem('背后捅人刀', 'Fallere825', null, '/背后捅人刀(?!）)(?:（Fallere825）)?/');

	// 我が身の全ては亡き友のために(Intimus115)
	$items[] = new HighlightItem('Intimus115', '为亡友献上我的一切', null, '/Intimus115(?!）)(?:（为亡友献上我的一切）)?/');
	$items[] = new HighlightItem('为亡友献上我的一切', 'Intimus115', null, '/为亡友献上我的一切(?!）)(?:（Intimus115）)?/');

	// 礎を担いし者(Basis104)
	$items[] = new HighlightItem('Basis104', '基础担当者', null, '/Basis104(?!）)(?:（基础担当者）)?/');
	$items[] = new HighlightItem('基础担当者', 'Basis104', null, '/基础担当者(?!）)(?:（Basis104）)?/');

	// その涙の理由を変える者(Flere210)
	$items[] = new HighlightItem('Flere210', '改变眼泪理由的人', null, '/Flere210(?!）)/');
	$items[] = new HighlightItem('改变眼泪理由的人', 'Flere210', null, '/改变眼泪理由的人(?!）)(?:（Flere210）)?/');//16
}

{// Great Names
	$items[] = new HighlightItem('圣乔治之龙');//聖ジョージのドラゴン
	$items[] = new HighlightItem('圣乔治');//聖ジョージ

	$items[] = new HighlightItem('圣布雷斯', 'St. Blaise', null, '/圣布雷斯(?:（(?:St\. ?)?Blaise）)?/');//07

	$items[] = new HighlightItem('彼得');//09
	$items[] = new HighlightItem('圣伯多禄', 'St. Pietro', null);//10
	$items[] = new HighlightItem('圣彼得');//10

	$items[] = new HighlightItem('似神者',       'Michael', '火');//神の如き者(ミカエル)
	$items[] = new HighlightItem('似神者米迦勒', 'Michael', '火');//神の如き者(ミカエル)//14
	$items[] = new HighlightItem('神之药', 'Raphael', '土');//神の薬(ラファエル)
	$items[] = new HighlightItem('神之力', 'Gabriel', '水');//神の力(ガブリエル)
	$items[] = new HighlightItem('神之火', 'Uriel',   '风');//神の火(ウリエル)

	$items[] = new HighlightItem('发光者路西法',   'Lucifer', '堕天使', '/发光者路西法(（lucifer）)?/');//光を掲げる者(ルシフェル)//13
	$items[] = new HighlightItem('光之使者路西法', 'Lucifer', '堕天使');                                //光を掲げる者(ルシフェル)//14
	$items[] = new HighlightItem('光之使者',       'Lucifer', '堕天使');                                //光を掲げる者(ルシフェル)//16

//	$items[] = new HighlightItem('/(雷神)?索尔/', 'Thor', null);//雷神トール//17:
}

	return $items;
}

function Highlight_character_character_other() { // sort, cat, jpn
	$items = array();

{// 主要人物の関係者
	ArrCharHighlightItem($items, '上条 刀夜');//上条 刀夜
	ArrCharHighlightItem($items, '上条 诗菜');//上条 詩菜
	ArrCharHighlightItem($items, '龙神 乙姫');//竜神 乙姫
	ArrCharHighlightItem($items, '御坂 旅挂');//御坂 旅掛
	ArrCharHighlightItem($items, '御坂 美铃');//御坂 美鈴
	$items[] = new HighlightItem('斯芬克');//スフィンクス
}

{// ロシア連邦
	//エカリエーリャ＝A＝プロンスカヤ
	//ディグルヴ
	//グリッキン
	//アンツェカ＝S＝クファルク
	//セリック＝G＝キールノフ
}

{// アメリカ合衆国
	//ロベルト＝カッツェ
	//ローズライン＝クラックハルト
	//オーレイ＝ブルーシェイク
	//リンディ＝ブルーシェイク
	//ハーザック＝ローラス
	//バックス＝シェルヴァ
	//ニケ＝カノークス
	//アーク＝ダニエルズ
	//アルフレッド＝サードマン
	//ウェック＝ルナサンド
	//スティーブ
	//マーティン＝フラワーズ
	//エルート＝ラックス
	//シャオロン＝ハルヴァード
	//ジョージ＝キングダム
}

{// ナチュラルセレクター関係者
}

{// その他
	$items[] = new HighlightItem('一一一', null, '偶像明星');//一一 一
	$items[] = new HighlightItem('/火野神作|火野|神作(?!祟)/');//火野 神作
	//イネス
	//ステファニー＝ゴージャスパレス
	//田中
	//ミュッセ
	//エーカー＝ルゴーニ
	$items[] = new HighlightItem('穆西');//ジェニー
	ArrCharHighlightItem($items, '艾卡·鲁格尼', '·');//エドワード＝トーキー
	//キネシック＝エヴァーズ
	//レイモンド＝カールマン
	//密着微生物
}

	return $items;
}


function Highlight_ability_replace() {// sort, cat, jpn
	$items = array();

{// science
	// 強度(レベル)
	$items[] = New_Highlight__Re('等级５', '等级五', 'Level 5', null);//14
	$items[] = New_Highlight__Re('等级４', '等级四', 'Level 4', null);//14
	$items[] = New_Highlight__Re('等级$1', '/Level ([0-5])(?!）)/', '$0', null);//15

	// 能力
	//幻想殺し(イマジンブレイカー)
	$items[] = New_Highlight__Re('幻想杀手', '幻象杀手', '幻想殺し(Imagine Breaker)', '原石, Level 0');//13
	//原子崩し(メルトダウナー)
	$items[] = New_Highlight__Re('原子崩坏', '原子崩塌', '原子崩し(Melt Downer)', 'Level 5, No.2');//15
	//窒素装甲(オフェンスアーマー)
	$items[] = New_Highlight__Re('氮气装甲', '窒素装甲', '窒素装甲(Offense Armor)', 'Level 4');//15
	//能力追跡(AIMストーカー)
	$items[] = New_Highlight__Re('能力追踪', '/能力追迹(?:（AIM Stalker）)?/', '能力追跡(AIM Stalker)', 'Level 4');//15
}


{// 魔術
	//ルーン魔術
	$items[] = New_Highlight__Re('符文魔法', '卢文魔法');//18
	//回復魔術
	$items[] = New_Highlight__Re('回复魔法', '复原魔法');//18

	//人払い(Opila)
	$items[] = New_Highlight__Re('驱除闲人', '驱人', 'Opila', null);//16
	//ゴーレム＝エリス
	$items[] = New_Highlight__Re('石巨人艾利丝', '泥巨人爱丽丝',  'Golem Ellis', null);//17
	$items[] = New_Highlight__Re('石巨人艾利丝', '哥雷姆·艾丽丝', 'Golem Ellis', null);//18
	$items[] = New_Highlight__Re('石巨人', '泥巨人', 'Golem', null);//17
	$items[] = New_Highlight__Re('石巨人', '哥雷姆', 'Golem', null);//18
	$items[] = New_Highlight__Re('艾利丝', '爱丽丝', 'Ellis', null);//17
	$items[] = New_Highlight__Re('艾利丝', '艾丽丝', 'Ellis', null);//18
	//天罰術式
	$items[] = New_Highlight__Re('天谴术式', '天罚术式');//13
	//聖人崩し
	$items[] = New_Highlight__Re('圣人崩坏', '圣人崩落');//16
}

	return $items;
}

function Highlight_ability_translate() {// cat, jpn
	$items = array();

{// 能力
}


{// 魔術
	//パターン魔術
	$items[] = new Highlight__Tr('/(?<=「)模型(?=」)|(?<=『)模型(?=』)/');//18
	//全次元切断術式
	$items[] = new Highlight__Tr('全次元切断');//18
}

	return $items;
}


function Highlight_ability() {
	$items = array();

	$items[] = new HighlightItem('异能之力');//異能の力

	return $items;
}

function Highlight_ability_science() {// sort, cat, jpn
	$items = array();

{// 強度(レベル)
	$items[] = new HighlightItem('等级5超能力者',  'Level 5', null);
	$items[] = new HighlightItem('等级５超能力者', 'Level 5', null);

	$items[] = new HighlightItem('等级5超能力',  'Level 5', null);
	$items[] = new HighlightItem('等级５超能力', 'Level 5', null);

	$items[] = new HighlightItem('绝对能力者', 'Level 6', null);
	$items[] = new HighlightItem('超能力者', 'Level 5', null, '/超能力者（Level ?5）/');
	$items[] = new HighlightItem('大能力者', 'Level 4', null, '/大能力者(?:（Level 4）)?/');
	$items[] = new HighlightItem('强能力者', 'Level 3', null);
	$items[] = new HighlightItem('异能力者', 'Level 2', null);
	$items[] = new HighlightItem('低能力者', 'Level 1', null);
	$items[] = new HighlightItem('无能力者', 'Level 0', null, '/无能力者(?:（Level 0）)?/');

	$items[] = new HighlightItem('绝对能力', 'Level 6', null, '/绝对能力(?!(进化)?(实验|计划))/');
	$items[] = new HighlightItem('超能力', 'Level 5', null, '/超能力（Level 5）|(?<=等级5的)超能力/');
	$items[] = new HighlightItem('大能力', 'Level 4', null, '/大能力(?:（Level 4）)?/');
	$items[] = new HighlightItem('强能力', 'Level 3', null);
	$items[] = new HighlightItem('异能力', 'Level 2', null);
	$items[] = new HighlightItem('低能力', 'Level 1', null);
	$items[] = new HighlightItem('无能力', 'Level 0', null);

	$items[] = new HighlightItem('等级6',  'Level 6', null);
	$items[] = new HighlightItem('等级5',  'Level 5', null);
	$items[] = new HighlightItem('等级4',  'Level 4', null);
	$items[] = new HighlightItem('等级3',  'Level 3', null);
	$items[] = new HighlightItem('等级2',  'Level 2', null);
	$items[] = new HighlightItem('等级1',  'Level 1', null);
	$items[] = new HighlightItem('等级0',  'Level 0', null);

	$items[] = new HighlightItem('等级６', 'Level 5', null);
	$items[] = new HighlightItem('等级５', 'Level 5', null);
	$items[] = new HighlightItem('等级４', 'Level 4', null);
	$items[] = new HighlightItem('等级３', 'Level 3', null);
	$items[] = new HighlightItem('等级２', 'Level 2', null);
	$items[] = new HighlightItem('等级１', 'Level 1', null);
	$items[] = new HighlightItem('等级零', 'Level 0', null);
}

{// 能力者
	$items[] = new HighlightItem('多重能力者', '多重能力者(Dual Skill)', null);//多重能力者(デュアルスキル)//12
	$items[] = new HighlightItem('引火能力者', '発火能力者(Pyrokinesis)', null);//発火能力者(パイロキネシス)//06(3)
	$items[] = new HighlightItem('发火能力者', '発火能力者(Pyrokinesis)', null);//発火能力者(パイロキネシス)//06(1)
	$items[] = new HighlightItem('发电能力者', '発電能力者(Electro Master)', null);//発電能力者(エレクトロマスター)//06(1) 13(1)
	$items[] = new HighlightItem('读心能力者', '読心能力者(Psychometry)', null);//読心能力者(サイコメトリー)//03

	$items[] = new HighlightItem('电击能力者', '電撃使い(Electro Master)', null);//電撃使い(エレクトロマスター)//03
	$items[] = new HighlightItem('风能力者',   '風力使い(Aero Shooter)', null);//風力使い(エアロシューター)//08
	$items[] = new HighlightItem('风能力者',   '風使い(Aero Shooter)',   null);//風使い(エアロシューター)//03
	$items[] = new HighlightItem('空力能力者', '空力使い(Aero Hand)', null);//空力使い(エアロハンド)//08
	$items[] = new HighlightItem('思念操纵者', '思念使い(Materialize)', null);//思念使い(マテリアライズ)//01

	$items[] = new HighlightItem('$1', 'Radio Noise', null, '/(量产型超?能力者|量产型电击能力者)(?:（Radio Noise）)?/');//量産異能者(レディオノイズ)//03

	$items[] = new HighlightItem('空间移动能力者', '空間移動(Teleport)能力者', null);//空間移動(テレポート)能力者//06
	$items[] = new HighlightItem('念动能力者', '念動能力者', null);//念動能力者//06
	$items[] = new HighlightItem('音波能力者', '音波能力者', null);//音波能力者//06
	$items[] = new HighlightItem('搜寻能力者', 'ナーチ能力者', null);//ナーチ能力者//15
}

{// 能力
	//http://www12.atwiki.jp/index-index/pages/1577.html

	//冥土帰し(ヘヴンキャンセラー)
	//一方通行
	$items[] = new HighlightItem('未元物质', '未元物質(Dark Matter)', 'Level 5, No.2', '/未元物质(?:（Dark Matter）)?/');//未元物質(ダークマター)//15
	$items[] = new HighlightItem('多重能力', '多重能力(Dual Skill)', null);//多重能力(デュアルスキル)//06

	// 原石
	$items[] = new HighlightItem('幻想杀手', '幻想殺し(Imagine Breaker)', '原石, Level 0', '/幻想杀手(?:（Imagine Breaker）)?/');//幻想殺し(イマジンブレイカー)//01
	$items[] = new HighlightItem('吸血杀手', '吸血殺し(Deep Blood)', '原石', '/吸血杀手(?:（Deep Blood）)?/');//吸血殺し(ディープブラッド)//02
	$items[] = new HighlightItem('念动炮弹', '念動砲弾(Attack Crash)', '原石, Level 5');//念動砲弾(アタッククラッシュ)//SS2

	// 念動力
	$items[] = new HighlightItem('念动力',   '念動力(Telekinesis)', null);//念動力(テレキネシス)//01
	$items[] = new HighlightItem('念动能力', '念動力能(Telekinesis)', null);//念動能力(サイコキネシス)//03
	$items[] = new HighlightItem('冲击扩散', '衝撃拡散(Shock Absorber)', null);//衝撃拡散(ショックアブソーバー)//09

	// 発火能力
	$items[] = new HighlightItem('引火能力', '発火能力(Pyrokinesis)', null);//発火能力(パイロキネシス)//01

	// 電撃使い/発電能力
	$items[] = new HighlightItem('电击能力', '電撃使い(Electro Master)', null);//電撃使い(エレクトロマスター)//03(1) 05(4) 06(1) 08(2)
	$items[] = new HighlightItem('发电能力', '発電能力(Electro Master)', null);//発電能力(エレクトロマスター)//15
	//発電能力//15
	$items[] = new HighlightItem('超电磁炮', '超電磁砲(Railgun)', 'Level 5, No.3', '/超电磁炮(?:（Railgun）)?/');//超電磁砲(レールガン)//01
	$items[] = new HighlightItem('缺陷电力', '欠陥電気(Radio Noise)', 'Level 2, Level 3', '/缺陷电力(?:（Radio Noise）)?/');//欠陥電気(レディオノイズ)//03
	$items[] = new HighlightItem('原子崩坏', '原子崩し(Melt Down)', 'Level 5, No.4', '/原子崩坏(?:（Melt Downer）)?/');//原子崩し(メルトダウナー)//15 19

	// 大気制御
	$items[] = new HighlightItem('氮气装甲', '窒素装甲(Offense Armor)', 'Level 4', '/氮气装甲(?:（Offense Armor）)?/');//窒素装甲(オフェンスアーマー)//15
	$items[] = new HighlightItem('空气气球', '空気風船(Air bag)', null);//空気風船(エアバッグ)//09

	// 空间移动
	$items[] = new HighlightItem('空间移动能力', '空間移動能力(Teleport)', null);//空間移動能力(テレポート)//02
	$items[] = new HighlightItem('空间移动', '空間移動(Teleport)', 'Level 4', '/空间移动(?:（Teleport）)?/');//空間移動(テレポート)//06
	$items[] = new HighlightItem('坐标移动', '座標移動(Move Point)', 'Level 4', '/坐标移动(?:（Move Point）)?/');//座標移動(ムーブポイント)//08
	$items[] = new HighlightItem('死角移动', '死角移動(Kill Point)', null);//死角移動(キルポイント)//15

	// 肉体
	$items[] = new HighlightItem('肉体再生', '肉体再生(Auto Rebirth)', 'Level 0');//肉体再生(オートリバース)//04
	$items[] = new HighlightItem('肉体变化', '肉体変化(Metamorphose)', null);//肉体変化(メタモルフォーゼ)//05

	// 透視能力
	$items[] = new HighlightItem('透视能力', '透視能力(Clairvoyance)', null);//透視能力(クレアボイアンス)

	// 精神感応/念話能力
	$items[] = new HighlightItem('精神感应',     '精神感応(Telepath)', null);                                 //精神感応(テレパス)     //01(1)
	$items[] = new HighlightItem('心电感应能力', '念話能力(Telekinesis)', null);                              //念話能力(テレキネシス) //01(1)
	$items[] = new HighlightItem('心电感应',     '念話能力(Telepath)', null);                                 //念話能力(テレパス)     //06(9)
	$items[] = new HighlightItem('念话能力',     '念話能力(Telepathy)', null, '/念话能力(?:（Tele Pass）)?/');//念話能力(テレパシー)   //09(2)

	$items[] = new HighlightItem('读心能力', '読心能力(Psychometry)', null);//読心能力(サイコメトリー)//01
	$items[] = new HighlightItem('意见解析', '意見解析(Skill Polygraph)', null, '/意见解析(?:（Skill Polygraph）)?/');//意見解析(スキルポリグラフ)//15
	$items[] = new HighlightItem('记忆操作', '記憶操作(Mind Hound)', null);//記憶操作(マインドハウンド)//01
	$items[] = new HighlightItem('洗脑能力', '洗脳能力(Marionette)', null);//洗脳能力(マリオネッテ)//01
	$items[] = new HighlightItem('心理定规', '心理定規(Measure Heart)', null, '/心理定规(?:（Measure Heart）)?/');//心理定規(メジャーハート)//15 19
	$items[] = new HighlightItem('心理掌握', '心理掌握(Mental Out)', 'Level 5, No.5');//心理掌握(メンタルアウト)//16

	// AIM
	$items[] = new HighlightItem('真相不明', '正体不明(Counter Stop)', null, '/真相不明(?!的|地)(?:（Counter Stop）)?/');//正体不明(カウンターストップ)//06
	$items[] = new HighlightItem('能力追踪', '能力追跡(AIM Stalker)', 'Level 4');//能力追跡(AIMストーカー)//19

	//
	$items[] = new HighlightItem('预知能力', '予知能力(Far Vision)', null);//予知能力(ファービジョン)//08
}

	$items[] = new HighlightItem('龙王之颚', 'Dragon Strike', null);//竜王の顎(ドラゴンストライク)//02:3223

{// 技
	$items[] = new HighlightItem('雷击之枪');//炎の魔術師//01:144
}

	return $items;
}

function Highlight_ability_magic() {// sort, cat, jpn
	$items = array();

	// 魔術師
	$items[] = new HighlightItem('符文魔法师');//ルーンの魔術師//01:1749
	$items[] = new HighlightItem('火焰魔法师');//炎の魔術師//01:1755

{// 魔術
	$items[] = new HighlightItem('十字术式');//十字術式//04
	$items[] = new HighlightItem('佛教术式');//仏教術式//04
	$items[] = new HighlightItem('神道术式');//神道術式//04
	$items[] = new HighlightItem('防护术式');//防護術式//06
	$items[] = new HighlightItem('天使术式');//天使の術式//07
	$items[] = new HighlightItem('水之术式');//水の術式//09
	$items[] = new HighlightItem('防御术式');//防御術式//11
	$items[] = new HighlightItem('移动术式');//移動術式//14
	$items[] = new HighlightItem('优先术式');//優先術式//14
	$items[] = new HighlightItem('自杀术式');//自殺術式//15
	$items[] = new HighlightItem('圣母崇拜术式');//聖母崇拝術式//16
	$items[] = new HighlightItem('击坠术式');//撃墜術式//17

	$items[] = new HighlightItem('符文魔法');//ルーン魔術//01:1101
	$items[] = new HighlightItem('回复魔法');//回復魔術//01:1295
	$items[] = new HighlightItem('火焰魔法');//炎の魔術//01:3053
	$items[] = new HighlightItem('黑魔法');//黒魔術//04:1269
	$items[] = new HighlightItem('对十字教黑魔法', 'Anti-God Black Art', null);//対十字教黒魔術(アンチゴッドブラックアート)//01:3053
	$items[] = new HighlightItem('地图魔法');//地図の魔術//07:882
	$items[] = new HighlightItem('逆探魔法');//09:1421
	$items[] = new HighlightItem('星座魔法');//星座の魔術//10:1602
	$items[] = new HighlightItem('防御魔法');//防御魔術//13:1746
	$items[] = new HighlightItem('折纸魔术');//折り紙の魔術//14
	$items[] = new HighlightItem('优先魔法');//優先魔術//14
	$items[] = new HighlightItem('分解魔法');//分解魔術//15
	$items[] = new HighlightItem('死者魔法');//死者の魔術//15
	$items[] = new HighlightItem('治疗魔法');//治癒の魔術//16
	$items[] = new HighlightItem('凭灵魔法', 'Seiðr', null, '/凭灵(（Seiar）)?魔法/');//セイズ魔術//16

	$items[] = new HighlightItem('炎剑');//炎剣//01:974
	$items[] = new HighlightItem('猎杀魔女之王', 'Innocentius', null, '/猎杀魔女之王(?:（Innocentius）)?/');//魔女狩りの王(イノケンティウス)//01:1059//01(32) 02(09) 07(08) 10(09) 11(01)
	$items[] = new HighlightItem('魔女狩猎之王', 'Innocentius', null, '/魔女狩猎之王(?:（Innocentius）)?/');//魔女狩りの王(イノケンティウス)//       //09(01)
	$items[] = new HighlightItem('Innocentius', '猎杀魔女之王', null, '/Innocentius(?:）)/');
	$items[] = new HighlightItem('自动书记');//自動書記(ヨハネのペン)//01:1363
	$items[] = new HighlightItem('圣乔治圣域');//聖ジョージの聖域//01:2922
	$items[] = new HighlightItem('龙王的叹息', 'Dragon Breath', null, '/龙王的叹息(?:（Dragon Breath）)?/');//竜王の殺息(ドラゴンブレス)//01:2969
	//神啊，你为何舍弃了我//神よ、何故私を見捨てたのですか(エリ・エリ・レマ・サバクタニ)//01:3053
	$items[] = new HighlightItem('金色大衍术', '黄金練成(Ars Magna)', null);//黄金練成(アルス＝マグナ)/02(15) 03(2) 04(2) 06(1) 07(1)
	$items[] = new HighlightItem('黄金大衍术', '黄金練成(Ars Magna)', null);//黄金練成(アルス＝マグナ)//13(1)
	$items[] = new HighlightItem('大衍术',     '黄金練成(Ars Magna)', null, '/大衍术(?:（Ars Magna）)?/');//黄金練成(アルス＝マグナ)//02(10)
	$items[] = new Highlight__Tr('黄金炼成',   'Ars Magna',           null);//黄金練成(アルス＝マグナ)//13tr(1) 14tr(1)
	$items[] = new HighlightItem('葛利果圣歌队', 'Gregorian Choir', null);//グレゴリオの聖歌隊/真・聖歌隊(グレゴリオ＝クアイア)//02:1471
	$items[] = new HighlightItem('伪圣歌队', 'Gregorian Replica', null);//偽・聖歌隊(グレゴリオ＝レプリカ)02:1629
	$items[] = new HighlightItem('瞬间炼金', 'Lumen Magna', null);//瞬間錬金(リメン＝マグナ)//02:1674
	$items[] = new HighlightItem('海市蜃楼', '/海市蜃楼(?!之都)/');//蜃気楼//02:1724
	$items[] = new HighlightItem('天使坠落', 'Angel Fall', null);//御使堕し(エンゼルフォール)//04:25//04(146) 07(3)
	$items[] = new HighlightItem('天使堕落', 'Angel Fall', null);//御使堕し(エンゼルフォール)       //09(2)
	$items[] = new HighlightItem('赤术式');//赤ノ式//04:809//04(1) 10(5)
	$items[] = new HighlightItem('红之式');//赤ノ式        //09(2)
	$items[] = new HighlightItem('黑术式');//黒ノ式        //04(2)
	$items[] = new HighlightItem('黑之式');//黒ノ式        //09(1)
	//極大地震(アースシェイカー)//04:2709
	//異界反転(ファントムハウンド)//04:2709
	//永久凍土(コキュートスレプリカ)//04:2709
	$items[] = new HighlightItem('石巨人艾利丝', 'Golem Ellis', null);//ゴーレム＝エリス//06:1069
	$items[] = new HighlightItem(      '艾利丝',       'Ellis', null);//ゴーレム＝エリス
	$items[] = new HighlightItem('石巨人艾莉丝', 'Golem Ellis', null);//ゴーレム＝エリス//11 12
	$items[] = new HighlightItem(      '艾莉丝',       'Ellis', null);//ゴーレム＝エリス
	$items[] = new HighlightItem('石巨人',       'Golem',       null);//ゴーレム＝エリス
	$items[] = new HighlightItem('强制咏唱', 'Spell Intercept', null);//強制詠唱(スペルインターセプト)//06:2623
	$items[] = new HighlightItem('缩图巡礼');//縮図巡礼(しゅくずじゅんれい)//07:1119
	$items[] = new HighlightItem('魔灭之声');//魔滅の声(シェオールフィア)//07:2511
	$items[] = new HighlightItem('理派四阵');//理派四陣//09:1422
	$items[] = new HighlightItem('占术圆阵');//占術円陣//09:1603
	$items[] = new HighlightItem('截断气息');//気配断ち//10:2992
	$items[] = new HighlightItem('天谴术式');//天罰術式//13:2897
	$items[] = new HighlightItem('光之处刑');//光の処刑//15
	$items[] = new HighlightItem('圣母的慈悲');//聖母の慈悲//16
	$items[] = new HighlightItem('圣人崩坏');//聖人崩し//16
	$items[] = new HighlightItem('圣母之家');//ロレートの家

	$items[] = new HighlightItem('驱除闲人', 'Opila', null, '/驱除闲人(?:（Opila）)?/');//ルーン人払い(Opila)//01(1) 02(3) 04(3) 09(3) 10(5) 11(2)
	$items[] = new HighlightItem('驱散闲人', 'Opila', null, '/驱散闲人(?:（Opila）)?/');       //人払い(Opila)//02(1) 07(2)
	$items[] = new HighlightItem('laguz', null, '水的符文');//laguz(ラグズ)//16

	// 結界
	$items[] = new HighlightItem('防御结界');//防御結界//01:299
	$items[] = new HighlightItem('禁丝结界');//禁糸結界//04:1472
}

{// 技
	$items[] = new HighlightItem('七闪');//七閃
	$items[] = new HighlightItem('唯闪');//唯閃
	$items[] = new HighlightItem('七教七刃');//七教七刃//14
}

	return $items;
}


function Highlight_terminology_replace() {// sort, cat, jpn
	$items = array();

{// science
	// 暗部
	//グループ
	$items[] = New_Highlight__Re('集团', '/(?<=[「『])(Group)(?=[』」])/',  null, '土御门元春／海原光贵／结标淡希／一方通行');//15
	//スクール
	$items[] = New_Highlight__Re('学校', '/(?<=[「『])(School)(?=[』」])/', null, '垣根帝督／心理定规／砂皿致密／UNKNOWN');//15
	//ブロック
	$items[] = New_Highlight__Re('区块', '/(?<=[「『])(Block)(?=[』」])/',  null, '佐久辰彦／手盐惠未／山手／铁网');//15
	//アイテム
	$items[] = New_Highlight__Re('道具', '/(?<=[「『])(Item)(?=[』」])/',   null, '麦野沈利／绢旗最爱／芙兰达／泷壶理后');//15
	//メンバー
	$items[] = New_Highlight__Re('人员', '/(?<=[「『])(Member)(?=[』」])/', null, '博士／马场 芳郎／席琪桃尔／查乐');//15
	//ドラゴン
	$items[] = New_Highlight__Re('龙', '/(?<=[「『])(Dragon)(?=[』」])/');//15

	// 学校
	//霧ヶ丘女学院
	$items[] = New_Highlight__Re('雾丘女子学院', '雾丘女校',     null, '第十八学区');//15
	$items[] = New_Highlight__Re('雾丘女子学院', '雾丘女子学校', null, '第十八学区');//19

	// 役職
	//警備員(アンチスキル)
	$items[] = New_Highlight__Re('警卫',  '警备员',                   'Anti-Skill', null);//14
	$items[] = New_Highlight__Re('警卫', '/警备员（Anti[ -]Skill）/', 'Anti-Skill', null);//14

	// 技術
	//自分だけの現実
	$items[] = New_Highlight__Re('个人现实', '/Personal Reality(?!）)/', 'Personal Reality', null);//15

	// 実験
	//暗闇の五月計画
	$items[] = New_Highlight__Re('黑暗的五月计划', '暗暗的五月计划');//15
	//暴走能力の法則解析用誘爆実験
	$items[] = New_Highlight__Re('失控能力的法则解析用诱爆实验', '暴走能力的法则解析用诱爆实验');//15

	
}

{// magic
	// 宗教
	//必要悪の教会(ネセサリウス)
	$items[] = New_Highlight__Re('必要之恶教会', '必要恶教会', 'Necessarius', null);//14
	//アニェーゼ部隊
	$items[] = New_Highlight__Re('雅妮丝部队', '亚捏赛部队');//14
	$items[] = New_Highlight__Re('雅妮丝部队', '亚涅赛部队');//18

	// 存在, 魔術師
	//神の子
	$items[] = new HighlightItem('神子', '神之子');//13
	//魔術師
	$items[] = New_Highlight__Re('魔法师', '魔术师');//13
	$items[] = New_Highlight__Re('魔法', '魔术');//13

	// 技術
	//ルーン
	$items[] = New_Highlight__Re('符文', '如尼文字');//16
}

	//「0930」事件
	$items[] = New_Highlight__Re('〇九三〇事件', '0930事件');//15
	$items[] = New_Highlight__Re('「〇九三〇」事件', '「0930」事件');//15

	return $items;
}

function Highlight_terminology_translate() {// cat, jpn
	$items = array();

	// 部隊
	//迎電部隊(スパークシグナル)
	$items[] = new Highlight__Tr('迎电部队', 'Spark Signal', null, '/迎电部队(?:（Spark Signal）)?/');//19


	// 実験
	//第三次製造計画(サードシーズン)
	$items[] = new Highlight__Tr('第三次制造计划');//20

	// 道具
	//クレムリン・レポート
	$items[] = new Highlight__Tr('克里姆林·报告', 'Доклад Кремль(Kremlin Reports)', null);//20

	// 計画
	//プロジェクト＝ベツレヘム
	$items[] = new Highlight__Tr('伯利恒计划', 'Project Bethlehem', null);//20


	//ブリテン・ザ・ハロウィン
	$items[] = new Highlight__Tr('不列颠万圣之夜事件');//20
	//第三次世界大戦
	$items[] = new Highlight__Tr('第三次世界大战');//20

	return $items;
}


function Highlight_terminology_science() {// sort, cat, jpn
	$items = array();

{// 組織
	$items[] = new HighlightItem('科学阵营');
	$items[] = new HighlightItem('科学势力');
	$items[] = new HighlightItem('科学世界');

	$items[] = new HighlightItem('学园都市');//学園都市

	$items[] = new HighlightItem('科学宗教');//02
	$items[] = new HighlightItem('科学结社', 'Asociacion de cienia', null);//科学結社//08
}

{// 暗部
	$items[] = new Highlight_Img('集团', 'Group',  '土御门元春／海原光贵／结标淡希／一方通行', '/(?<=[「『])(集团)(?=[』」])/', 'team_group2_100h.jpg');//グループ//15
	$items[] = new Highlight_Img('学校', 'School', '垣根帝督／心理定规／砂皿致密／UNKNOWN', '/(?<=[「『])(学校)(?=[』」])/', 'team_school_100h.jpg');//スクール//15
	$items[] = new Highlight_Img('区块', 'Block',  '佐久辰彦／手盐惠未／山手　　／铁网', '/(?<=[「『])(区块)(?=[』」])/', 'team_block2_100h.jpg');//ブロック//15
	$items[] = new Highlight_Img('道具', 'Item',   '麦野沉利　／绢旗最爱／芙兰达／泷壶理后', '/(?<=[「『])(道具)(?=[』」])/', 'team_item2_100h.jpg');//アイテム//15
	$items[] = new Highlight_Img('人员', 'Member', '博士　／马场芳郎／索绮特　／查乐', '/(?<=[「『])(人员)(?=[』」])/', 'team_member3_100h.jpg');//メンバー//15
}

{// 部隊
	$items[] = new HighlightItem('搜索部队', 'Hound Dog', null);                                //捜索部隊(ハウンドドッグ)//03:1142
	$items[] = new HighlightItem('猎犬部队', 'Hound Dog', null, '/猎犬部队(?:（Hound Dog）)?/');//猟犬部隊(ハウンドドッグ)//12:2493
}

{// 学校
	$items[] = new HighlightItem('常盘台中学', null, '学舍之园(第七学区)');//常盤台中学//01:726
	$items[] = new HighlightItem('常盘台');
	$items[] = new HighlightItem('雾丘女子学院', null, '第十八学区');//霧ヶ丘女学院//06:766
	$items[] = new HighlightItem('雾丘');
	$items[] = new HighlightItem('缭乱家政女子学校');// 繚乱家政女学校//09:40
	$items[] = new HighlightItem('重点上机学园');//長点上機学園//09:374
	$items[] = new HighlightItem('某高中', null, '第七学区');//とある高校//12:467
}

{// 学校行事
	$items[] = new HighlightItem('大霸星祭', null, '体育祭');//大覇星祭//体育祭//07
	$items[] = new HighlightItem('一端览祭', null, '文化祭');//一端覧祭//文化祭//07
}

{// 役職
	$items[] = new HighlightItem('统括理事长');//総括理事長//02:257
	$items[] = new HighlightItem('统括理事会');//統括理事会//09:25
	$items[] = new HighlightItem('警卫', 'Anti Skill', null, '/警卫(?!机器人)/');//警備員(アンチスキル)//01:275
	$items[] = new HighlightItem('风纪委员', 'Judgement', null, '/风纪委员(?!第一七七支部)(?:（Judgement）)?/');//風紀委員(ジャッジメント)//01:275
	$items[] = new HighlightItem('抛弃物', 'Child Error', null);//置き去り(チャイルドエラー)//12:1557
	$items[] = new HighlightItem('开发员', 'Developer', null);//開発官(デペロッパー)//08:1830
	$items[] = new HighlightItem('营运委员');//実行委員//09:15
	$items[] = new HighlightItem('实行委员');//実行委員//17
	$items[] = new HighlightItem('武装无能力集团', 'Skill Out', null);//武装無能力集団(スキルアウト)//12:292
	$items[] = new HighlightItem('Skill Out', null, '由无能力者组成的武装组织');//武装無能力集団(スキルアウト)//15
	$items[] = new HighlightItem('航空警备员');//航空警備員//17
	$items[] = new HighlightItem('空服员', 'Flight Attendant', null);//フライトアテンダント//17
}

{// 存在
	$items[] = new HighlightItem('没有才能的人');
	$items[] = new HighlightItem('有才能的人');
	$items[] = new HighlightItem('科学家');
	// 能力者
	$items[] = new HighlightItem('超能力者');//超能力者
	$items[] = new HighlightItem('能力者');//能力者
	$items[] = new HighlightItem('原石');//原石//SS2
}

{// 技術
	$items[] = new HighlightItem('一般科学');
	$items[] = new HighlightItem('科学');//科学(ゲンジツ)

	$items[] = new HighlightItem('SYSTEM', '以非神之身理解天意', null);//神ならぬ身にて天上の意思に辿り着くもの(SYSTEM)//03:1215
	$items[] = new HighlightItem('以非神之身理解天意', 'SYSTEM', null);//神ならぬ身にて天上の意思に辿り着くもの(SYSTEM)

	//AIM拡散力場//06:324
	$items[] = new HighlightItem('AIM扩散力场', 'An Involuntary Movement', null);
	$items[] = new HighlightItem('AIM',         'An Involuntary Movement', null, '/AIM(?![-_0-9a-zA-Z]|干扰器)/');
	$items[] = new HighlightItem('An_Invountary_Movement', 'AIM', null);

	//虚数学区・五行機関//01:1735
	$items[] = new HighlightItem('虚数学区·五行机关', 'Primary Knowledge', null);
	$items[] = new HighlightItem('虚数学区', 'Primary Knowledge', null);
	$items[] = new HighlightItem('五行机关', 'Primary Knowledge', null);

	$items[] = new HighlightItem('个人现实', 'Personal Reality', null, '/个人现实(?:（Personal Reality）)?/');//自分だけの現実//03:1202

	$items[] = new HighlightItem('超能力');//超能力

	$items[] = new HighlightItem('身体检查', 'System Scan', null);//身体検査(システムスキャン)//01:100
	$items[] = new HighlightItem('安全等级', 'Security Rank', null);//セキュリティランク//02::928
	$items[] = new HighlightItem('御坂网路', 'Misaka Network', null);//ミサカネットワーク//05:545 //05(13) 08(4) 12(1) 13(10)
	$items[] = new HighlightItem('御坂网络', 'Misaka Network', null);//ミサカネットワーク//12:1125               12(2)
	$items[] = new HighlightItem('警戒层级', 'Security Code', null);//警備強度(セキュリティコード)//05:1925
	$items[] = new HighlightItem('第一级警戒', 'Code Red',    null);//コードレッド
	$items[] = new HighlightItem('第二级警戒', 'Code Orange', null);//コードオレンジ
	$items[] = new HighlightItem('第三级警戒', 'Code Yellow', null);//コードイエロー
	$items[] = new HighlightItem('红色警戒', 'Code Red',    null);//コードレッド
	$items[] = new HighlightItem('橙色警戒', 'Code Orange', null);//コードオレンジ
	$items[] = new HighlightItem('特别警戒宣言', 'Code Red',    null);//特別警戒宣言(コードレッド)
	$items[] = new HighlightItem('代理演算');//代理演算//12:1039
}

{// 実験
	//量産型能力者計画(レディオノイズけいかく)
//	$items[] = new HighlightItem('/量产型?超?能力者(开发)?计划|超能力者?量产(计划|实验)|(等级5)?(超能力者)?「?超电磁炮」?量产型?(开发)?计划/');
	$items[] = new HighlightItem('超电磁炮量产计划');//03(1) 06(1)
	$items[] = new HighlightItem('量产型超能力者计划');//05(4)
	$items[] = new HighlightItem('等级5超能力者「超电磁炮」量产型开发计划');//05(1)
	$items[] = new HighlightItem('超能力者量产计划');//06(1)
	$items[] = new HighlightItem('超能力者量产实验');//08(2)
	$items[] = new HighlightItem('量产能力者开发计划');//12(1)
	$items[] = new HighlightItem('量产能力者计划');//13(1)
	$items[] = new HighlightItem('量产超能力者计划');//13(1)

	//絶対能力進化(レベル6シフト)
//	$items[] = new HighlightItem('$1', 'Level 6 Shift', null, '/((等级6)?绝对能力(进化)?(实验|计划))(?:（Level 6 Shift）)?/');
	$items[] = new HighlightItem('等级6绝对能力实验');//04(1)
	$items[] = new HighlightItem('等级6绝对能力进化实验');//05(1) 06(1)
	$items[] = new HighlightItem(     '绝对能力进化实验', '/绝对能力进化实验(?:（Level 6 Shift）)?/');//08(2) 13tr(1) 19tr(1)
	$items[] = new HighlightItem('等级6绝对能力计划');//05(2) 06(1)
	$items[] = new HighlightItem('等级6绝对能力进化计划');//12(1)
	$items[] = new Highlight__Tr(     '绝对能力进化计划');//20tr(1)

	$items[] = new HighlightItem('制作人', 'Produce', null, '/(?<=[「『])制作人(?=[』」])/');//プロデュース//12(1)
	$items[] = new HighlightItem('/黑暗的?五月计划/');//暗闇の五月計画//12 15
	$items[] = new HighlightItem('/失控能力的?法则解析用诱爆实验/');//暴走能力の法則解析用誘爆実験//12 15
}

	return $items;
}

function Highlight_terminology_magic() {// sort, cat, jpn
	$items = array();

{// 組織
	$items[] = new HighlightItem('魔法阵营');
	$items[] = new HighlightItem('魔法势力');
	$items[] = new HighlightItem('教会势力');
	$items[] = new HighlightItem('魔法世界');
	$items[] = new HighlightItem('教会世界');//教会世界(マジカル)//03:1228
	$items[] = new HighlightItem('魔法领域');
	$items[] = new HighlightItem('魔法业界');//魔術業界

	// 英国
	$items[] = new HighlightItem('王室派');//王室派//16
	$items[] = new HighlightItem('皇室派');//王室派//07
	$items[] = new HighlightItem('骑士派');//騎士派
	$items[] = new HighlightItem('清教派');//清教派

	$items[] = new HighlightItem('英国王室');//英国王室//16
}

{// 宗教
	$items[] = New_Highlight__Re('十字教', '基督教', null, '翻译错误');//十字教//03:423
	$items[] = new HighlightItem('十字教');//十字教
	$items[] = New_Highlight__Re('旧教', '天主教', 'Catholic', '翻译错误');//旧教(カトリック)
	$items[] = New_Highlight__Re('新教', 'Protestant', null);//新教(プロテスタント)

	$items[] = new HighlightItem('英国清教');//イギリス清教//01
	$items[] = new HighlightItem('必要之恶教会', 'Necessarius', null);//必要悪の教会(ネセサリウス)//01
	$items[] = new HighlightItem('第零圣堂区', null, '必要之恶教会(Necessarius)');//第零聖堂区//01
	$items[] = new HighlightItem('先枪骑士团', '1stLancer', '英国清教所属十三个骑士团之一');//先槍騎士団(1stLancer)//02
	$items[] = new HighlightItem('铁杖骑士团', '7th_Macer', '英国清教所属十三个骑士团之一');//鉄杖騎士団(7th_Macer)//02
	$items[] = new HighlightItem('双斧骑士团', '5th_Axer',  '英国清教所属十三个骑士团之一');//両斧騎士団(5th_Axer)//02
	ArrCharHighlightItem($items, '天草式 十字凄教');//天草式十字凄教//04
	$items[] = new HighlightItem('新生天草式十字凄教');//新生天草式十字凄教//17
	$items[] = new HighlightItem('雅妮丝部队');//アニェーゼ部隊//10

	$items[] = new HighlightItem('罗马正教');//ローマ正教//01
	$items[] = new HighlightItem('十三骑士团');//十三騎士団//02
	$items[] = new HighlightItem('神之右席');//神の右席//11
	$items[] = new HighlightItem('西班牙星教派');//16

	$items[] = new HighlightItem('俄罗斯成教');//ロシア成教//01
	$items[] = new HighlightItem('歼灭白书', 'Annihilatus', null, '/歼灭白书(?:（Annihilatus）)?/');//殲滅白書(Annihilatus)//04

	//北欧神話

	$items[] = new HighlightItem('神道');//神道
	$items[] = new HighlightItem('佛教');//仏教
	$items[] = new HighlightItem('阿兹特克', 'Aztec', null);//アステカ神話
	$items[] = new HighlightItem('道教');//道教
	//ギリシア神話
	//スラヴ神話
}

{// 魔術結社
	$items[] = new HighlightItem('魔法组织');//01:1736
	$items[] = new HighlightItem('魔法结社', 'Magic Cabal', null);//魔術結社(マジックキャバル)//01:355
	$items[] = new HighlightItem('结社预备军');//結社予備軍//17

	$items[] = new HighlightItem('黄金黎明', 'S∴M∴', null);//黄金夜明（S∴M∴）//01
	$items[] = new HighlightItem('S∴M∴', '黄金黎明', null);//黄金夜明（S∴M∴）//01
	//明け色の陽射し
	//宵闇の出口
	//暗闇を拭う夜明け

	$items[] = new HighlightItem('蔷薇十字');//薔薇十字(ローゼンクロイツ)//01
	//オルレアン騎士団
	//占星施術旅団

	//世界樹を絶やさぬ者
	//知を刻む鉄杭
	//海より来たる覇者
	//神の剣の文字を知る者
	//地の中で黄金を鍛える槌

	//翼ある者の帰還
	$items[] = new HighlightItem('新生之光', 'N∴L∴', null);//新たなる光
	$items[] = new HighlightItem('N∴L∴', '新生之光', null);//新たなる光
	//グレムリン（GREMLIN）

	$items[] = new HighlightItem('黄金魔法结社');//黄金系結社
	$items[] = new HighlightItem('占星施术旅团');//占星施術旅団//16
	$items[] = new HighlightItem('奥尔良骑士团');//オルレアン騎士団//16
}

{// 役職
	$items[] = new HighlightItem('英国国王');
	$items[] = new HighlightItem('英国女王', 'Queen Regnant', null);//英国女王(クイーンレグナント)//10
	$items[] = new HighlightItem('英国女皇', 'Queen Regnant', null);//英国女王(クイーンレグナント)//07
	$items[] = new HighlightItem('/(英国)?(第[一二三]|第一、第二、第三)皇女/', null, null);//第一王女/第二王女/第三王女//15
	//騎士団長(ナイトリーダー)
	//最大主教(アークビショップ)

	$items[] = new HighlightItem('最高主教', 'Archbishop', null);//最大主教(アークビショップ)//07//07(17) 09(5) 10(5) 12(10)
	$items[] = new HighlightItem('最大主教', 'Archbishop', null);//最大主教(アークビショップ)//           09(1)
	$items[] = new HighlightItem('女教皇', 'Priestess', null);//女教皇(プリエステス)//04
	$items[] = new HighlightItem('代理教皇');//教皇代理//07
	$items[] = new HighlightItem('「代理」教皇');//教皇代理//16

	$items[] = new HighlightItem('教皇', 'Pope', null);//教皇
	$items[] = new HighlightItem('枢机主教', 'Cardinal Bishop', null);//07
	$items[] = new Highlight__Tr('总大主教', 'Major Archbishop', null);//20
	$items[] = new HighlightItem('大主教');//大司教//09
	$items[] = new HighlightItem('主教', 'Bishop', null, '/司教(?!十字)/');//司教//09
	$items[] = new HighlightItem('隐秘纪录官', 'Cansellarius', null);//隠秘記録官(カンセラリウス)

	$items[] = new HighlightItem('异端审问官', 'Inquisitioner', null);//異端審問官(インクジショナー)

	$items[] = new HighlightItem('法国国王');//フランス国王//14
}

{// 存在, 魔術師
	$items[] = new HighlightItem('天使长');//天使長
	$items[] = new HighlightItem('大天使');//大天使
	$items[] = new HighlightItem('堕落天使');//堕天使
	$items[] = new HighlightItem('堕天使');//堕天使
	$items[] = new HighlightItem('天使');//天使

	$items[] = new HighlightItem('神子');  //神の子
	$items[] = new HighlightItem('神上', 'La persona superiore a Dio', null);//神上//14
	$items[] = new HighlightItem('La persona superiore a Dio', '神上', null);//神上//14

	$items[] = new HighlightItem('吸血鬼');//吸血鬼

	$items[] = new HighlightItem('施术者');//術者//01
	$items[] = new HighlightItem('术者');//術者//06

	$items[] = new HighlightItem('魔法师');//魔術師//01
	$items[] = new HighlightItem('魔导师');//魔導師//01
	$items[] = new HighlightItem('魔神');//魔神//01
	$items[] = new HighlightItem('圣人');//聖人

	$items[] = new HighlightItem('炼金术师');//錬金術師//01
	$items[] = new HighlightItem('阴阳博士');//陰陽博士//04
}

{// 技術
	$items[] = new HighlightItem('非现实', 'Occult', null, '/(?<=[「『])非现实(?=[』」])/');//非現実/(オカルト)//01
	$items[] = new HighlightItem('非科学');//11
	$items[] = new HighlightItem('神秘学', '/神秘学(?!说)/');//02

	$items[] = new HighlightItem('天使之力', 'Telesma', null);//天使の力(テレズマ)//01
	$items[] = new HighlightItem('世界的力量');//世界の力(せかいのちから)
	$items[] = new HighlightItem('神的祝福', 'Telesma', null);//神の祝福(ゴッドブレス)//01
	$items[] = new HighlightItem('灵体', 'Telesma', null);//テレズマ

	$items[] = new HighlightItem('偶像崇拜', 'Idol', null);//偶像崇拝(アイドル)//01:503
	$items[] = new Highlight_Img('生命之树', 'Sephiroth', null, '/生命之树(?:（Sephiroth）)?/', '284px-Tree_of_life_hebrew.png');//セフィロトの樹//02:749
	$items[] = new Highlight_Img('卡巴拉之树', 'Sefirot in Kabbalah', null, 'tree_of_life_hebrew.png');//カバラの樹//04:445
	$items[] = new HighlightItem('卡巴拉', 'Kabbalah', null);
	$items[] = new HighlightItem('偶像理论');//偶像の理論(ぐうぞうのりろん)//07:488
	$items[] = new HighlightItem('圣母崇拜');//聖母崇拝//16

	//ルーン
	$items[] = new HighlightItem('符文刻印');//01:1092
	$items[] = new HighlightItem('符文文字', 'Rune', null);//01
	$items[] = new HighlightItem('符文', 'Rune', null, '/符文(（RUNE）)?/');//01

	$items[] = new HighlightItem('魔法名');//魔法名//01

	$items[] = new HighlightItem('术式');//術式//01

	$items[] = new HighlightItem('近代西洋魔法');//近代西洋魔術//07
	$items[] = new HighlightItem('大魔法');//大魔術//04
	$items[] = new HighlightItem('魔法');//魔術//01
	$items[] = new HighlightItem('战术魔法阵', 'Tactical Circle', null);//戦術魔法陣(タクティカルサークル)//04:2709
	$items[] = new HighlightItem('独特魔法阵', 'Original Circle', null);//創作魔法陣(オリジナルサークル)//04:2709
	$items[] = new HighlightItem('魔法阵');//魔法陣//01
	$items[] = new HighlightItem('炼金术');//錬金術
	$items[] = new HighlightItem('阴阳道');//陰陽道//02

	$items[] = new HighlightItem('类超能力', '偽装能力(Dummy Skill)', '炼金术模拟超能力');//偽装能力(ダミースキル)//01
}

{// 道具
	$items[] = new HighlightItem('灵装');//霊装
}

{// 計画
}

	return $items;
}

function Highlight_terminology_events() {// sort, jpn
	$items = array();

//	$items[] = new HighlightItem('/九月三十日那起的事件|九月三十日事件|九月三十日的那事件/');//九月三〇日の事件//14
	$items[] = new HighlightItem('/(〇九三〇|[「『]〇九三〇[』」])事件/');//「0930」事件//15

	return $items;
}


function Highlight_equipment_replace() {// sort, cat, jpn
	$items = array();

	// 機械
	$items[] = New_Highlight__Re('树状图设计者', '树形图的设计者', 'Tree Diagram', null);//樹形図の設計者(ツリーダイアグラム)//13:3303

{// 兵器
	//HsAFH-11(六枚羽)//無人攻撃ヘリ
	$items[] = New_Highlight__Re('六翼', '/六[枚片]羽(?!翼)/', 'HsAFH-11', '无人攻击直升机');//15 19
	// 駆動鎧
	//駆動鎧(パワードスーツ)
	$items[] = New_Highlight__Re('驱动铠', '/驱动铠(?!甲)(?:（Power(?:ed)? Suit）)?/', 'Powered Suit', null);//13:4233
	// 銃器
	//鋼鉄破り(メタルイーターMX)
	$items[] = New_Highlight__Re('钢铁破坏者MX', '合金吞噬者MX', 'Metal Eater MX', null);//13:657
	//オモチャの兵隊(トイソルジャー)
	$items[] = New_Highlight__Re('玩具兵团', '玩具兵队', 'Toy Soldier', 'F2000R');//13:657
}


{// 霊装
	//歩く教会
	$items[] = New_Highlight__Re('移动教会', '步行教会');//13:2587
	//トラウィスカルパンテクウトリの槍
	$items[] = New_Highlight__Re('托拉维斯卡邦提克乌托里之枪', '托拉维斯卡邦缇克乌拖里之枪', 'Tlahuizcalpantecuhtli Spear', null);//15:225
	//スレイプニル
	$items[] = New_Highlight__Re('斯雷普尼尔', '史普雷尼尔', 'Sleipnir', null);//16:1087
	$items[] = New_Highlight__Re('斯雷普尼尔', '斯雷普尼亚', 'Sleipnir', null);//20
	//アスカロン
	$items[] = New_Highlight__Re('阿斯卡隆', '阿斯卡龙', 'Ascalon', null);//17:1420
	//カーテナ＝オリジナル
	$items[] = New_Highlight__Re('正统卡提纳', '卡提那一世',      'Curtana Original', null);//17
	$items[] = New_Highlight__Re('正统卡提纳', '卡提尔·正统',     'Curtana Original', null);//18
	$items[] = New_Highlight__Re('正统卡提纳', '卡提尔·Original', 'Curtana Original', null);//20
	//カーテナ＝セカンド
	$items[] = New_Highlight__Re('卡提纳二世', '卡提那二世',    'Curtana Second', null);//17
	$items[] = New_Highlight__Re('卡提纳二世', '卡提尔·second', 'Curtana Second', null);//18
	$items[] = New_Highlight__Re('卡提纳二世', '卡提尔·Second', 'Curtana Second', null);//20
	//カーテナ
	$items[] = New_Highlight__Re('卡提纳', '卡提那', 'Curtana', null);//17
	$items[] = New_Highlight__Re('卡提纳', '卡提尔', 'Curtana', null);//18
	//雷神の槌(ミョルニル)
	$items[] = New_Highlight__Re('雷神之锤', '/(雷神的大槌)?米约尔尼尔/', 'Mjöllnir', null);//17
	//鋼の手袋
	$items[] = New_Highlight__Re('钢铁手套', '钢之手套');//17
	//知の角杯(ギャッラルホルン)
	$items[] = New_Highlight__Re('智慧角杯', '知性角杯', 'Gjallarhorn', null);//17
	$items[] = New_Highlight__Re('智慧角杯', '智之号角', 'Gjallarhorn', null);//20
	//大船の鞄(スキーズブラズニル)
	$items[] = New_Highlight__Re('Skidhbladhnir', 'Skidhbladhnir（大船之鞄）', '大船之箱(Skíðblaðnir)', null);//17:2063
	$items[] = New_Highlight__Re('大船之箱', '大船之鞄', 'Skíðblaðnir', null);//17:2156
	//フルンティング
	$items[] = New_Highlight__Re('弗仑汀', '佛仑丁', 'Hrunting', null);//18
}

	// 聖霊十式
	//アドリア海の女王
	$items[] = New_Highlight__Re('亚德里亚海女王', '亚德里亚海之女王', null, '「女王舰队」旗舰');//20:1615

	// 武器
	//マクアフティル
	$items[] = New_Highlight__Re('马克胡特', '马库阿夫提鲁', 'Macuahuitl', null);//15

	// 要塞
	//カヴン＝コンパス
	$items[] = New_Highlight__Re('女巫罗盘', '卡乌·康帕斯', 'Coven Compass', '英国清教的移动要塞');//17
	$items[] = New_Highlight__Re('女巫罗盘', '高文·导向',   'Coven Compass', '英国清教的空中要塞');//18
	return $items;
}

function Highlight_equipment_translate() {// sort, cat, jpn
	$items = array();

{// 機械
}

{// 兵器
	//超音速戦闘機
	$items[] = new Highlight__Tr('HsF-00', null, '超音速战斗机');//20:77

	// 駆動鎧
}

{// 薬品
}


{// 霊装
	//カーテナ＝サード
	$items[] = new Highlight__Tr('卡提尔·third', 'Curtana Third', null);//18

	//ブリューナク
	$items[] = New_Highlight__Re('布里欧那克', '布里欧纳克', 'Brionac', '贯通之枪', '/Brionac（布里欧纳克）/');//17
	//封の足枷(ドローミ)
	$items[] = new Highlight__Tr('封印足枷', 'Drómi', null);//20
	//デュランダル
	$items[] = new Highlight__Tr('德兰达尔', 'Durandal', null);//20
}

{// 武器
}

{// 要塞
	//セルキー＝アクアリウム
	$items[] = new Highlight__Tr('亚露琪·深海舰', 'Selkie Aquarium', '英国清教的水中要塞');//18
	$items[] = new Highlight__Tr('亚露琪',        'Selkie',          '英国清教的水中要塞');//18
	//グリフォン＝スカイ
	$items[] = new Highlight__Tr('格列弗·航空', 'Griffin Sky', '英国的攻城战用移动要塞');//18
	//グラストンベリ
	$items[] = new Highlight__Tr('格拉斯顿伯里', 'Glastonbury', '英国的移动要塞');//20
}

	return $items;
}


function Highlight_equipment_science() {// sort, cat, jpn
	$items = array();

{// 機械
	$items[] = new HighlightItem('书库', 'Bank', null);//書庫(バンク)//01:152
	$items[] = new HighlightItem('学习装置', 'Testament', null);//学習装置(テスタメント)//03:24

	$items[] = new HighlightItem('树状图设计者', 'Tree Diagram', null, '/树状图设计者(?:（Tree Diagram）)?/');//樹形図の設計者(ツリーダイアグラム)//03(33) 05(04) 08(29)
	$items[] = new HighlightItem('树形图设计者', 'Tree Diagram', null);                                       //樹形図の設計者(ツリーダイアグラム)//12(01)
	$items[] = new HighlightItem('残骸', 'Remnant', '「树状图设计者」残骸', '/(?<=[「『])残骸(?=[』」])|残骸(?:（Remnant）)/');//残骸(レムナント)//08:750
	$items[] = new HighlightItem('Remnant',   null, '「树状图设计者」残骸');                                                   //残骸(レムナント)//08:21
	$items[] = new HighlightItem('演算中枢', 'Silicorundum', '「树状图设计者」演算中枢', '/(?<=[「『])演算中枢(?=[』」])/');//演算中枢(シリコランダム)//08:1151
	$items[] = new HighlightItem('Silicorundum',       null, '「树状图设计者」演算中枢');                                   //演算中枢(シリコランダム)//08:735
	$items[] = new HighlightItem('牛郎星Ⅱ号');//ひこぼしⅡ号//15

	$items[] = new HighlightItem('夜视镜');//暗視(NV)ゴーグル//03:237
	$items[] = new HighlightItem('发信器', 'Nano-devices', null);//発信機(ナノデバイス)//04:60
	$items[] = new HighlightItem('颈链型电极');//チョーカー型電極//12:1023
	$items[] = new HighlightItem('显微操作仪', 'Micro Manipulator', null);//マイクロマニピュレータ//12:2363
	$items[] = new HighlightItem('嗅觉感应器');//嗅覚センサー//13:489
	$items[] = new HighlightItem('妨碍气流', 'Wind Defense', null);//妨害気流(ウィンドディフェンス)//15
	$items[] = new Highlight_Img('镊子', '超微粒物体干涉用吸附式操作器', null, '/(?<=「)镊子(?=」)|(?<=『)镊子(?=』)/', 'pin_set.jpg');//ピンセット//超微粒物体干渉吸着式マニピュレーター//15
	$items[] = new Highlight_Img('超微粒物体干涉用吸附式操作器', '镊子', null,                                          'pin_set.jpg');//ピンセット//超微粒物体干渉吸着式マニピュレーター//15
	$items[] = new HighlightItem('AIM干扰器', 'AIM Jammer', null);//AIMジャマー//15
	$items[] = new HighlightItem('滞空回线', 'Under Line', null, '/滞空回线(?:（Under Line）)?/');//滞空回線(アンダーライン)//15
	$items[] = new HighlightItem('主库存记录器', 'Master Recorder', null);//マスターレコーダー//17

	$items[] = new HighlightItem('医院车');//病院車//13:1896
	$items[] = new HighlightItem('空中巴士365');//スカイバス365//17
	$items[] = new HighlightItem('欧洲之星', 'Eurostar', null);//ユーロスター//17
}

{// 兵器
	$items[] = new HighlightItem('HsB-02', null, '超音速隐形轰炸机');//HsB-02//超音速ステルス爆撃機//14
	$items[] = new HighlightItem('地壳破断', 'Grounding Blade', null);//地殻破断(アースブレード)//14
	$items[] = new HighlightItem('HsAFH-11', '六翼', '无人攻击直升机');                               //HsAFH-11(六枚羽)//無人攻撃ヘリ 六枚羽//15:1438
	$items[] = new HighlightItem('六翼', 'HsAFH-11', '无人攻击直升机', '/(?<=[「『])六翼(?=[』」])/');//HsAFH-11(六枚羽)//無人攻撃ヘリ 六枚羽//15:1626
	$items[] = new HighlightItem('合欢', 'Mimosa', null);//オジギソウ//15

	$items[] = new HighlightItem('集束炸弹', 'Bunker Cluster', null, '/集束炸弹(（Bunker Cluster）)?/');//バンカークラスター//17
	// 駆動鎧
	$items[] = new HighlightItem('驱动铠甲', 'Powered Suit', null, '/驱动铠甲(?:（Powered Suit）)?/');//駆動鎧(パワードスーツ)//13:4233
	$items[] = New_Highlight__Re('驱动铠甲', '驱动重甲', 'Powered Suit', null);                                   //駆動鎧(パワードスーツ)//13:4233
	$items[] = new Highlight_Img('HsPS-15', '巨大兵器(Large Weapon)', '试作型驱动铠甲', 'HsPS-15_300.jpg');//HsPS-15(ラージウェポン)//14
	// 旧型駆動鎧
	$items[] = new HighlightItem('MPS-79', null, '旧型驱动铠甲');//旧型駆動鎧//15
	// 駆動鎧銃器
	$items[] = new Highlight_Img('对隔墙用散弹枪', 'powered_suit_shotgun_300h.jpg');//対隔壁用ショットガン//14
	// 銃器
	$items[] = new HighlightItem('钢铁击破者MX', 'Metal Eater MX', null, '/钢铁击破者(?:（Metal Eater）)?MX/');//メタルイーターMX //03:22  //03(1)
	$items[] = new HighlightItem('钢铁破坏者MX', 'Metal Eater MX', null);                                      //メタルイーターMX //05:1651//13(1)
	$items[] = new HighlightItem('钢铁击破者',   'Metal Eater', null);//鋼鉄破り(メタルイーター)      //鋼鉄破り(メタルイーターMX)//03:22  //03(9)
	$items[] = new HighlightItem('钢铁破坏者',   'Metal Eater', null);//鋼鉄破り(メタルイーター)      //鋼鉄破り(メタルイーターMX)//05:1651//05(2)
	$items[] = new HighlightItem('F2000R', null, '玩具兵团(Toy Soldier)');                                  //オモチャの兵隊(トイソルジャー)//03:779
	$items[] = new HighlightItem('玩具兵',   'Toy Soldier', 'F2000R', '/玩具兵(?!团)(?:（Toy Soldier）)?/');//オモチャの兵隊(トイソルジャー)//03:779//03(1)
	$items[] = new HighlightItem('玩具兵团', 'Toy Soldier', 'F2000R');                                      //オモチャの兵隊(トイソルジャー)//13:664//13(1)
	$items[] = new HighlightItem('MSR-001', null, '磁力狙击炮');//磁力狙撃砲//15:388
}

{// 道具
	$items[] = new HighlightItem('西瓜杀手', 'Head Crash', '电动瓦斯枪');//西瓜割り(ヘッドクラッシュ)//03:1160
	$items[] = new HighlightItem('装甲服', 'Body Armor', null); //装甲服(ボディアーマー)//04:1459
	$items[] = new HighlightItem('无痛注射针', 'Mosquito Needle', null);//無痛注射針(モスキートニードル)//04:60
	$items[] = new HighlightItem('御坂网路连线用电池');//ミサカネットワーク接続用バッテリー//13:2612
}

{// 素材
	$items[] = new HighlightItem('演算型冲击扩散性复合材质', 'Calculate Fortress', null);//演算型・衝撃拡散性複合素材(カリキュレイト＝フォートレス)//02:227
}

{// 薬品
	$items[] = new HighlightItem('体晶', null, '能力体结晶', '/(?<=『)体晶(?=』)|(?<=「)体晶(?=」)/');//体晶//17
}

	return $items;
}

function Highlight_equipment_magic() {// sort, cat, jpn
	$items = array();

{// 霊装
	$items[] = new HighlightItem('移动教会');//歩く教会//01:459 //01(35) 02(6) 03(1) 04(1) 11(1)
	$items[] = new HighlightItem('行动教会');//歩く教会//10:1173//10(2) 13(1)
	$items[] = new HighlightItem('朗基努斯之枪', 'Lance of Longinus', null);//神様殺しの槍(ロンギヌスの槍)//01:466
	$items[] = new HighlightItem('项圈', '/(?<=『)项圈(?=』)|(?<=「)项圈(?=」)/');//首輪//01:2462
	$items[] = new HighlightItem('施术铠');//施術鎧//02:874
	$items[] = new HighlightItem('量産聖槍', 'Longinus Replica', null);//ロンギヌス＝レプリカ//02:874
	$items[] = new HighlightItem('假奥雷欧斯', 'Aureolus Dummy', null);//アウレオルス＝ダミー//02:1700
	$items[] = new HighlightItem('托拉维斯卡邦提克乌托里之枪', 'Tlahuizcalpantecuhtli Spear', null);//トラウィスカルパンテクウトリの槍//05:1262
	$items[] = new HighlightItem('梓弓');//梓弓//05:2994
	$items[] = New_Highlight__Re('柯尔特十字架', '日耳曼十字架', 'Celtic Cross', '翻译错误');//ケルト十字架//03:423
	$items[] = new HighlightItem('柯尔特十字架', 'Celtic Cross', null);//ケルト十字架//10:1164
	$items[] = new Highlight_Img('莲花杖', 'Lotus Wand', null, 'lotus_wand.jpg');//蓮の杖(ロータスワンド)//05:2515//05(1) 07(2)
	$items[] = new Highlight_Img('莲之杖', 'Lotus Wand', null, 'lotus_wand.jpg');//蓮の杖(ロータスワンド)//17
	$items[] = new Highlight_Img('天使之杖',                   'lotus_wand.jpg');//天使の杖              //07:2721//      07(9) 11(21)
	$items[] = new HighlightItem('司教之杖');//司教杖//07:2696
	$items[] = new HighlightItem('禁色之楔');//禁色の楔//11:432
	$items[] = new HighlightItem('刻限的十字架');//刻限のロザリオ//11:1459
	$items[] = new HighlightItem('圣芭芭拉的神炮');//聖バルバラの神砲//11:1586
	$items[] = new Highlight_Img('/((缠有|卷着|缠绕)有刺铁[丝线]的|巨大)+槌子/', 'hammer_of_vent_300h.jpg');//有刺鉄線を巻いたハンマー//13:1272
	$items[] = new Highlight_Img('C文书', 'Document of Constantine', '君士坦丁大帝之书', 'doc_of_c.jpg');//C文書//14
	$items[] = new Highlight_Img('君士坦丁大帝之书', 'C文书', 'Document of Constantine', 'doc_of_c.jpg');//C文書
	$items[] = new Highlight_Img('Document of Constantine', 'C文书', '君士坦丁大帝之书', 'doc_of_c.jpg');//C文書
	$items[] = new HighlightItem('斯雷普尼尔', 'Sleipnir', null);//スレイプニル//16
	$items[] = new HighlightItem('移动铁壁', null, '英国王室专用长距离护送马车');//移動鉄壁//16:2382
	$items[] = new HighlightItem('罗宾汉', 'Robin Hood', null);//ロビンフッド//17:1088
	$items[] = new HighlightItem('阿斯卡隆', 'Ascalon', null, '/阿斯卡隆(?!）)(（Ascalon）)?/');//アスカロン//17
	$items[] = new HighlightItem('Ascalon', '阿斯卡隆', null, '/Ascalon(?!）)(（阿斯卡隆）)?/');//アスカロン//17
	$items[] = new HighlightItem('正统卡提纳', 'Curtana Original', null);//カーテナ＝オリジナル//17
	$items[] = new Highlight_Img('卡提纳二世', 'Curtana Second', null, 'curtana_second_300h.jpg');//カーテナ＝セカンド//17
	$items[] = new HighlightItem('卡提纳',     'Curtana', null);//カーテナ//17
	$items[] = new HighlightItem('大船之箱', 'Skíðblaðnir', null);//大船の鞄(スキーズブラズニル)//17
	$items[] = new HighlightItem('云船',     'Skíðblaðnir', null, '/云船(（Skidbladnir）)?/');//スキーズブラズニル//17
	$items[] = new HighlightItem('雷神之锤', 'Mjöllnir', null, '/雷神之锤(?!）)(（Mjollnir）)?/');//雷神の槌(ミョルニル)//17
	$items[] = new HighlightItem('钢铁手套');//鋼の手袋//17
	$items[] = new HighlightItem('智慧角杯', 'Gjallarhorn', null);//知の角杯(ギャッラルホルン)//17
	$items[] = new HighlightItem('布里欧那克', 'Brionac', '贯通之枪', '/布里欧那克(（Brionac）)?/');//ブリューナク//17
	$items[] = new HighlightItem('贝亚德', 'Bayard', null);//ベイヤード//18
	$items[] = new HighlightItem('弗仑汀', 'Hrunting', null);//フルンティング//18
	$items[] = new HighlightItem('主神之枪', 'Gungnir', null);//主神の槍(グングニル)//18
	$items[] = new HighlightItem('飞空剑', 'Fragarach', null);//空飛ぶ剣(フラガラッハ)//18
	$items[] = new HighlightItem('贯通之枪', 'Brionac', null);//貫通の槍(ブリューナク)//18
}

{// 聖霊十式
	$items[] = new HighlightItem('圣灵十式');//聖霊十式
	$items[] = new Highlight_Img('使徒十字', 'Croce di Pietro', '彼得的十字架', 'croce_di_pietro.jpg');//使徒十字(クローチェディピエトロ)
	$items[] = new Highlight_Img('彼得的十字架', 'Croce di Pietro', '使徒十字', 'croce_di_pietro.jpg');//使徒十字(クローチェディピエトロ)
	$items[] = new HighlightItem('刺突杭剑', 'Stab Sword', null);//刺突杭剣(スタブソード)
	$items[] = new HighlightItem('亚德里亚海女王', null, '「女王舰队」旗舰');//アドリア海の女王//Adriatic Sea
	$items[] = new HighlightItem('女王舰队');//女王艦隊
}

{// 魔道書
	$items[] = new HighlightItem('魔道书');//魔道書//01
	$items[] = new HighlightItem('原典', 'Origin', null);//原典(オリジン)//05
	$items[] = new HighlightItem('伪书');//偽書//05:3027
	$items[] = new HighlightItem('手抄本');//写本//05:3027
	$items[] = new HighlightItem('摹本');//写本//15
	$items[] = new HighlightItem('亚流');//01:419
	$items[] = new HighlightItem('伪作');//01:419

	$items[] = new HighlightItem('法之书', 'Liber AL vel Legis', null);//法の書//07:12
	$items[] = new Highlight_Img('速记原典', 'Shorthand', null, 'leaflet.jpg');//速記原典(ショートハンド)//09
	$items[] = new HighlightItem('历石');//暦石//15
}

{// 武器
	$items[] = new Highlight_Img('七天七刀', 'seven_sword_300h.jpg');//七天七刀//01:1919
	$items[] = new HighlightItem('西洋剑');//西洋剣//02:2933
	$items[] = new HighlightItem('仪典剑', 'Dress Sword', null);//ドレスソード//07:1303
	$items[] = new HighlightItem('焰形剑', 'Flamberge', null);//フランベルジェ//07:1444
	$items[] = new Highlight_Img('海军用船上枪', 'Friuli Spear', null, 'friuli_spear_300h.jpg');//海軍用船上槍(フリウリスピア)//11:2446
	$items[] = new HighlightItem('马克胡特', 'Macuahuitl', null);//マクアフティル//07:1303
	$items[] = new Highlight_Img('/[巨特]大的?铁棒/', 'giant_mace.jpg');//巨大なメイス//16
	$items[] = new HighlightItem('克利修麦德', 'Colichemarde', null, '克利修麦德(（Colichemarde）)?');//コリシュマルド//16
}

{// 要塞
	$items[] = new HighlightItem('女巫罗盘', 'Coven Compass', '英国清教的空中要塞', '/女巫罗盘(（Coven Compass）)?/');//カヴン＝コンパス//17
}

{// 道具
	$items[] = New_Highlight__Re('处刑塔的七道具', '处刑塔有名的拷问道具', null, '翻译错误');//ケルト十字架//01:1131
	$items[] = new Highlight_Img('符文纸',   'rune.jpg');//01:1742
	$items[] = new Highlight_Img('符文卡片', 'rune.jpg');//03:1690
	$items[] = new HighlightItem('纪念品', '/(?<=[「『])纪念品(?=[』」])/');//おみやげ//04:1658
	$items[] = new HighlightItem('大日本沿海舆地全图');//大日本沿海與地全図//07:883
	$items[] = new HighlightItem('盾牌纹章', 'Escutcheon', null);//盾の紋章(エスカッシャン)//16
	$items[] = new HighlightItem('盾之纹章', 'Escutcheon', null);//盾の紋章(エスカッシャン)//17
	$items[] = new HighlightItem('盾形纹章', 'Escutcheon', null);//盾の紋章(エスカッシャン)//17
}

{// 薬品
	$items[] = new HighlightItem('女巫之药');//魔女の薬//18
}
	return $items;
}


function Highlight_location_replace() {// sort, cat, jpn
	$items = array();

{// magic
	// 英国, イギリス清教
	//ウィンザー城
	$items[] = New_Highlight__Re('温莎堡', '温莎城', 'Windsor Castle', '英国女王官邸');//17
	//カンタベリー大聖堂
	$items[] = New_Highlight__Re('坎特伯利大教堂', '坎特伯雷大教堂', null, '「英国清教」总部');//17
	$items[] = New_Highlight__Re('坎特伯利',       '坎特伯雷'      , null, '「英国清教」总部');//17
	//ランベスの宮
	$items[] = New_Highlight__Re('朗伯斯宫', '兰柏宫', 'Lambeth Place', '「英国清教」最高主教官邸');//16

	// ローマ正教
	// 施設
	//教皇庁宮殿
	$items[] = New_Highlight__Re('教廷宫殿', '教皇厅宫殿');//14


}


	// 英国
	//フォークストーン
	$items[] = New_Highlight__Re('福克斯通', '弗克斯东', 'Folkestone', null);//17
	$items[] = New_Highlight__Re('福克斯通', '福克斯郡', 'Folkestone', null);//19

	// フランス(France)
	//アビニョン
	$items[] = new HighlightItem('法国');
	//トゥールーズ
	$items[] = New_Highlight__Re('土鲁斯', '图卢兹', 'Toulouse', '大陆简体：图卢兹<br>法国南部城市。欧洲航天产业基地。', '/图卢兹(（Toulouse）)?/');//14
	//アビニョン
	$items[] = New_Highlight__Re('亚维农', '阿维尼翁', 'Avignon', '大陆简体：阿维尼翁<br>法国南部城市。始建于罗马时期。', '../Location/250px-France_location_Avignon.jpg');//14
	$items[] = New_Highlight__Re('亚维农', '亚维尼翁', 'Avignon', '大陆简体：阿维尼翁<br>法国南部城市。始建于罗马时期。', '../Location/250px-France_location_Avignon.jpg');//15
	$items[] = New_Highlight__Re('亚维农', '阿维尼恩', 'Avignon', '大陆简体：阿维尼翁<br>法国南部城市。始建于罗马时期。', '../Location/250px-France_location_Avignon.jpg');//17

	// 英国 & フランス
	//ドーヴァー海峡//16(5) 17(3)
	$items[] = New_Highlight__Re('多佛海峡', '多佛尔海峡', 'Strait of Dover', null);//16 20
	$items[] = New_Highlight__Re('多佛海峡', '多弗海峡',   'Strait of Dover', null);//17
	//ドーバー海峡//17(2) 18(3)
	//17
	//18

	return $items;
}

function Highlight_location_translate() {
	$items = array();

	// 施設
	//フラフープ
	$items[] = new Highlight__Tr('Hula Hoop', null, '世界上最大的粒子加速器');//19:416


	//エリザリーナ独立国同盟
	$items[] = new Highlight__Tr('艾莉莎莉娜独立国同盟');//18
	$items[] = new Highlight__Tr('艾力扎里纳独立国同盟');//19
	$items[] = new Highlight__Tr('独立国同盟');//18

{// フランス(France)
}

	return $items;
}


function Highlight_location_science() {// sort, cat, jpn
	$items = array();

	$items[] = new HighlightItem('/第(十?[一二三四五六七八九十]|二十[一二三])学区/');//学区
	$items[] = new HighlightItem('学舍之园', null, '第七学区');//学舎の園//08:33

	// 施設
	$items[] = new HighlightItem('大众餐厅');//ファミレス//01:40
	$items[] = new HighlightItem('三泽塾', null, '第十七学区/第七学区');//三沢塾(みさわじゅく)//02:292
	$items[] = new HighlightItem('黑蜜堂', 'Chromium Congregate', null);//黒蜜堂//02:1342
	$items[] = new HighlightItem('没有窗户的大楼', null, '第七学区');//窓のないビル//03:765
	$items[] = new HighlightItem('返家浴院', null, '常盘台中学校舍附属淋浴室');//帰様の浴院//08:113
	$items[] = new HighlightItem('风纪委员第一七七支部', null, '第七学区');//第一七七支部//08:326
	$items[] = new HighlightItem(        '第一七七支部', null, '第七学区');//第一七七支部
	$items[] = new HighlightItem('铁身航空技术研究所附属实验机场', null, '第二三学区');//鉄身航空技術研究所付属実験空港//10:2067
	$items[] = new HighlightItem('雾丘附属');//霧ヶ丘付属//12:1570
	$items[] = new HighlightItem('特力研', '特例能力者多重调整技术研究所', null);//特力研//12:1544
	$items[] = new HighlightItem('特例能力者多重调整技术研究所');//特例能力者多重調整技術研究所
	$items[] = new HighlightItem('第三资源再生处理设施', null, '第五学区');//第三資源再生処理施設//13:850
	$items[] = new HighlightItem('Family Side', null, '黄泉川爱穗所住的公寓(第七学区)');//ファミリーサイド//15
	$items[] = new HighlightItem('病毒保管中心', null, '第五学区');//ウィルス保管センター//15
	$items[] = new HighlightItem('外部连结终端', null, '北部终端@第三学区<br>东部终端@第十二学区<br>南部终端@第二学区<br>西部终端@第十三学区');//外部接続ターミナル//15
	$items[] = new HighlightItem('次原子粒子工学研究所', null, '第十八学区');//素粒子工学研究所//15
	$items[] = new HighlightItem('航空宇宙工学研究所附属的卫星管制中心', null, '第二十三学区');//航空宇宙工学研究所付属 衛星管制センター//15
	$items[] = new HighlightItem('避暑胜地', null, '第二十二学区');//避暑地//15
	$items[] = new HighlightItem('制空权保全管制中心', null, '第二十三学区');//制空権保全管制センター//15
	$items[] = new HighlightItem('仓库街', null, '第十一学区');//倉庫街//15
	$items[] = new HighlightItem('外墙', null, '第十一学区', '/(?<=[「『])外墙(?=[』」])|(?<=·)外墙/');//外壁//15
	$items[] = new HighlightItem('感化院', null, '第十学区');//少年院//15
//	$items[] = new HighlightItem('地下街', null, '第二十二学区');//地下市街//16
	$items[] = new HighlightItem('超级度假胜地安泰泉', null, '地下市街(第二十二学区)');//スパリゾート安泰泉//16

	return $items;
}

function Highlight_location_magic() {// sort, cat, jpn
	$items = array();

{// 施設
	$items[] = new HighlightItem('教会');//01:210
	$items[] = new HighlightItem('大英博物馆', 'Arsenal', null);//大英博物館(アーセナル)//01:929
	$items[] = New_Highlight__Re('梵蒂冈图书馆', '梵蒂冈美术馆', null, '翻译错误');//バチカン図書館//01:929
	$items[] = new HighlightItem('梵蒂冈图书馆');//バチカン図書館
	$items[] = new HighlightItem('涡点');//渦//07:882
	$items[] = new HighlightItem('漩涡', '/(?<=[「『])漩涡(?=[』」])/');//渦//14
	$items[] = new HighlightItem('英国图书馆');//英国図書館//16
}

{// 英国, イギリス清教
	$items[] = new HighlightItem('圣乔治大圣堂', null, '「必要之恶教会」的根据地');//聖ジョージ大聖堂//01:599//01(02) 04(01) 06(02)
	$items[] = new HighlightItem('圣乔治大教堂', null, '「必要之恶教会」的根据地');//聖ジョージ大聖堂//07:39 //07(11) 09(02)
	$items[] = new HighlightItem('温莎堡', 'Windsor Castle', '英国女王官邸');//ウィンザー城//03:477
	$items[] = new HighlightItem('西敏寺', 'Westminster Abbey', '英国清教');//ウェストミンスター寺院//04:552
	$items[] = new HighlightItem('南华克大教堂', null, '英国清教');//サザーク大聖堂//04:552
	$items[] = new HighlightItem('处刑塔', null, '英国清教');//処刑塔//04:1131
	$items[] = new HighlightItem('圣保罗大教堂', 'St Paul\'s Cathedral', '英国清教');//聖ポール大聖堂//07:40
	$items[] = new HighlightItem('/坎特伯里(寺院)?/',   null, '「英国清教」总部');//カンタベリー寺院  //07:40
	$items[] = new HighlightItem('/坎特伯利(大教堂)?/', null, '「英国清教」总部');//カンタベリー大聖堂//09
	$items[] = new HighlightItem('兰伯斯宫', 'Lambeth Palace', '「英国清教」最高主教官邸', '/兰伯斯宫(?:（Lambeth Palace）)?/');//ランベスの宮07:3078//07(1)
	$items[] = new HighlightItem('朗伯斯宫', 'Lambeth Palace', '「英国清教」最高主教官邸');                                     //ランベスの宮       //12(4)
	$items[] = new HighlightItem('皇家艺术院', null, '英国清教');//王立芸術院//16

	$items[] = new HighlightItem('处女的寝室', 'Nail Bedroom', null);//処女の寝室(ネイルベッドルーム)//12:611

	$items[] = new HighlightItem('白金汉宫');//バッキンガム宮殿//16
	$items[] = new HighlightItem('皇后宫', 'The Queen\'s House', null, '/皇后宫(（The Queen\'s House）)?/');//クイーンズハウス//17
}

{// ローマ正教
	$items[] = new HighlightItem('拉特朗教堂');//ラテラノ聖堂//07:159
	$items[] = new HighlightItem('圣彼得大教堂', null, '「罗马正教」心脏的巨大教会');//聖ピエトロ大聖堂//09:2734
	$items[] = new HighlightItem('教廷宫殿', null, '罗马正教，亚维农/阿维尼翁(法国)');//教皇庁宮殿//14
}

{// ロシア成教
	$items[] = new HighlightItem('现象管理缩小重现设施', null, '俄罗斯成教');//現象管理縮小再現施設
}

	return $items;
}

function Highlight_location() {// sort, cat, jpn
	$items = array();

	// 施設
	$items[] = new HighlightItem('薄明座');//薄明座//07:294
	$items[] = new HighlightItem('平行甜点乐园',   'Parallel Sweets Park', null);//パラレルスウィーツパーク//07
	$items[] = new HighlightItem('平行甜甜圈乐园', 'Parallel Sweets Park', null);//パラレルスウィーツパーク//13
	$items[] = new HighlightItem('罗多里咖啡', 'Dorori Coffee', '日本咖啡连锁店<br>@亚维农/阿维尼翁(法国)');//ドローリコーヒー//14

	//
	$items[] = new HighlightItem('日本');
	$items[] = new HighlightItem('俄罗斯');
	$items[] = new HighlightItem('美国');
	$items[] = new HighlightItem('爱尔兰');

{// 英国
	$items[] = new HighlightItem('英国');
	$items[] = new HighlightItem('联合王国', 'United Kingdom', null);//連合王国(United Kingdom)

	$items[] = new HighlightItem('英格兰');
	$items[] = new HighlightItem('伦敦', 'London', null);//ロンドン
	$items[] = new HighlightItem('兰伯斯区', 'Lambeth', null, '/兰伯斯区(?:（Lambeth）)?/');//07(1)
	$items[] = new HighlightItem('朗伯斯区', 'Lambeth', null);                              //12(1)
	$items[] = new HighlightItem('兰贝斯区', 'Lambeth', null);                              //17
	$items[] = new HighlightItem('朗伯斯',   'Lambeth', null, '/朗伯斯(?!宫)(?:（Lambeth）)?/');  //11(1)
	$items[] = new HighlightItem('小威尼斯', 'Little Venice', null);//リトルベニス//16
	$items[] = new HighlightItem('利物浦', 'Liverpool', null);//リヴァプール//17
	$items[] = new HighlightItem('福克斯通', 'Folkestone', null, '/福克斯通(（Folkestone）)?/');//フォークストーン//18

	$items[] = new HighlightItem('苏格兰');//スコットランド
	$items[] = new HighlightItem('爱丁堡', 'Edinburgh', null);//エジンバラ//17

	$items[] = new HighlightItem('威尔斯');
	$items[] = new HighlightItem('北爱尔兰');
}

{// ローマ(Roma)
	$items[] = new HighlightItem('罗马');//ローマ
	$items[] = new HighlightItem('梵蒂冈市国', 'Vatican City State', null, '/梵蒂冈市国(?:（Vatican City State）)?/');//バチカン市国
	$items[] = new HighlightItem('梵蒂冈', 'Vatican', null);//バチカン
	$items[] = new HighlightItem('罗马教廷');//ローマ教皇領//09
	$items[] = new HighlightItem('罗马教皇领地');//ローマ教皇領//14
}

{// イタリア(Italyl)
	$items[] = new HighlightItem('意大利');
	$items[] = new HighlightItem('威尼斯');
	$items[] = new HighlightItem('亚德里亚海', 'Adriatic Sea', null);
	$items[] = new HighlightItem('威纳托省', 'Vento', null, '/威纳托省(（Vento）)?/');//11
	$items[] = new HighlightItem('利托里奥桥', 'Ponte Littorio', null, '/利托里奥桥(（Ponte Littorio）)?/');//11
	$items[] = new HighlightItem('维琴察', 'Vicenza', null, '/维琴察(（Vicenza）)?/');//11
	$items[] = new HighlightItem('帕多瓦', 'Padova', null, '/帕多瓦(（Padova）)?/');//11
	$items[] = new HighlightItem('巴萨诺格拉帕', 'Bassano del Grappa', null, '/巴萨诺格拉帕(（Bassano del Grappa）)?/');//11
	$items[] = new HighlightItem('贝鲁诺', 'Belluno', null, '/贝鲁诺(（Belluno）)?/');//11
	$items[] = new Highlight_Img('基奥贾', 'Chioggia', '意大利城市。位于威尼斯以南25公里处。', '/基奥贾(（Chioggia）)?/', '../Location/250px-Italyl_location_Chioggia.jpg');//11
	$items[] = new HighlightItem('泻湖区', 'Laguna', null, '/泻湖区(（Laguna）)?/');//11
	$items[] = new HighlightItem('梅特雷斯', 'Mestre', null, '/梅特雷斯(（Mestre）)?/');//11
	$items[] = new HighlightItem('维哥桥', 'Ponte di Vigo', null, '/维哥桥(（Ponte di Vigo）)?/');//11
	$items[] = new HighlightItem('索托马利那', 'Sotto Marina', null, '/索托马利那(（Sotto Marina）)?/');//11
	$items[] = new HighlightItem('丽都岛', 'Lido di Venezia', null, '/丽都岛(（Lido di Venezia）)?/');//11
	$items[] = new HighlightItem('梅斯特');//11
}

{// フランス(France)
	$items[] = new HighlightItem('法国');//フランス
	$items[] = new HighlightItem('巴黎', 'Paris', null);//パリ
	$items[] = new Highlight_Img('亚维农', 'Avignon', '大陆简体：阿维尼翁<br>法国南部城市。始建于罗马时期。', '../Location/250px-France_location_Avignon.jpg');//アビニョン
}

	// 英国 & フランス
	$items[] = new HighlightItem('多佛海峡', 'Strait of Dover', null);//ドーヴァー海峡//16
	$items[] = new HighlightItem('多佛',     'Dover'          , null);//ドーヴァー//17
	$items[] = new HighlightItem('欧陆隧道', 'Eurotunnel', null);//ユーロトンネル//17

	return $items;
}


function Highlight_other_replace() {// sort, cat, jpn
	$items = array();

	// 商品
	$items[] = New_Highlight__Re('晕太', '呱呱太');//ゲコ太//13
	$items[] = New_Highlight__Re('晕太', '呱太');//ゲコ太//16
	$items[] = New_Highlight__Re('跳子', '叽叽子');//ピョン子//13

	// 衣服

	return $items;
}

function Highlight_other_translate() {// cat, jpn
	$items = array();

	// 衣服
	$items[] = new Highlight__Tr('大精灵闪亮女仆');//18
	//小悪魔ベタメイド
	$items[] = new Highlight__Tr('小恶魔全面型女仆');//18
	//女神様ゴスメイド
	$items[] = new Highlight__Tr('女神殿下哥特女仆');//18

	return $items;
}


function Highlight_other() {// sort, cat, jpn
	$items = array();

	$items[] = new Highlight_Img('cuffs', null, '袖口', 'cuffs.jpg');//12:532

	// 劇中劇
	$items[] = new HighlightItem('超机动少女加奈美');//超機動少女カナミン(マジカルパワードカナミン)//15:2515//05(1) 06(3)
	$items[] = new HighlightItem('超机动少女佳奈美');//超機動少女カナミン(マジカルパワードカナミン)//12:2076//12(1)
	$items[] = new HighlightItem('超起动少女佳奈美Integral');//超起動少女カナミンインテグラル(マジカルパワード カナミンインテグラル)//16

	// 商品
	$items[] = new HighlightItem('暖洋洋羊咩咩');//あつあつシープさん//09:525
	$items[] = new HighlightItem('晕太');//ゲコ太//12:895
	$items[] = new HighlightItem('跳子');//ピョン子//12:1227
	$items[] = new HighlightItem('肩膀按摩夹小弟');//肩揉みホルダー君
	$items[] = new HighlightItem('随身天线服务', 'Handy Antenna Service', null);//ハンディアンテナサービス//12:887
	$items[] = new HighlightItem('一天捏一百次可以促进α波的健康球');//一日一〇〇回ニギニギするとα波が促進される健康ボール//14

	// 衣服
	$items[] = new HighlightItem('女仆装＋α');//メイド服＋α//12:1149
	$items[] = new HighlightItem('堕落天使女仆');//堕天使メイド//11:3412
	$items[] = new HighlightItem('堕天使女仆'  );//堕天使メイド//16
	$items[] = new Highlight_Img('堕天使色情女仆', 'maid_fallen_angel_v2_300h.jpg');//堕天使エロメイド//11:3412
	$items[] = new Highlight_Img('大精灵光之女仆', 'maid_fairy_300h.jpg');//大精霊チラメイド//17

	return $items;
}


class Highlight_Toaru_Majutsu_no_Index extends HighlightBase {
	function __construct() {

		$dic = array();

		$this->AddItemFunctionByCatName('');
		$this->AddItemFunctionByCatName('original');

		$this->AddItemFunctionByCatName('comment');

		$this->AddItemFunctionByCatName('escape');

		$this->AddItemFunctionByCatName('character', 'replace');
		$this->AddItemFunctionByCatName('character', 'translate');

		$this->AddItemFunctionByCatName('character science');
		$this->AddItemFunctionByCatName('character magic');
		$this->AddItemFunctionByCatName('character character_other');

		$this->AddItemFunctionByCatName('ability', 'replace');
		$this->AddItemFunctionByCatName('ability', 'translate');

		$this->AddItemFunctionByCatName('ability');
		$this->AddItemFunctionByCatName('ability science');
		$this->AddItemFunctionByCatName('ability magic');

		$this->AddItemFunctionByCatName('terminology', 'replace');
		$this->AddItemFunctionByCatName('terminology', 'translate');

		$this->AddItemFunctionByCatName('terminology science');
		$this->AddItemFunctionByCatName('terminology magic');
		$this->AddItemFunctionByCatName('terminology events');

		$this->AddItemFunctionByCatName('equipment', 'replace');
		$this->AddItemFunctionByCatName('equipment', 'translate');

		$this->AddItemFunctionByCatName('equipment science');
		$this->AddItemFunctionByCatName('equipment magic');

		$this->AddItemFunctionByCatName('location', 'replace');
		$this->AddItemFunctionByCatName('location', 'translate');

		$this->AddItemFunctionByCatName('location science');
		$this->AddItemFunctionByCatName('location magic');
		$this->AddItemFunctionByCatName('location');

		$this->AddItemFunctionByCatName('other', 'replace');
		$this->AddItemFunctionByCatName('other', 'translate');

		$this->AddItemFunctionByCatName('other');

		$this->sepcial_subtitile = '\d+（(?:Aug\.31|Sep\.01)_[AP]M\d{2}:\d{2}(?:[^<>（）]+)?）';

	}

	function parseCommentLightItems() {
		$items = parent::parseCommentLightItems();

		$items[] = new HighlightItem('作者|鎌池和馬', null, null, '/(?<=<p>)(作者\|鎌池和马)(?=<\/p>)/', 'comment-light');
		$items[] = new HighlightItem('$1┠$2┨$3', null, null, '/(<p>)((?:录入|扫图|发布于|译者(?=\|)|作者(?=\|)|插画(?=\|))[\/\|].+|未经许可，严禁转载|——轻之国度.+——)(<\/p>)/', 'comment-light');

		return $items;
	}
}

$highlight = new Highlight_Toaru_Majutsu_no_Index();

?>
