/**
 *  ueditor����������
 *  �������������������༭��������
 */
/**************************��ʾ********************************
 * ���б�ע�͵��������ΪUEditorĬ��ֵ��
 * �޸�Ĭ������������ȷ���Ѿ���ȫ��ȷ�ò�������ʵ��;��
 * ��Ҫ�������޸ķ�����һ����ȡ���˴�ע�ͣ�Ȼ���޸ĳɶ�Ӧ��������һ������ʵ�����༭��ʱ�����Ӧ������
 * �������༭��ʱ����ֱ��ʹ�þɰ������ļ��滻�°������ļ�,���õ��ľɰ������ļ�����ȱ���¹�������Ĳ��������½ű�����
 **************************��ʾ********************************/


(function () {
    /**
     * �༭����Դ�ļ���·����������ʾ�ĺ����ǣ��Ա༭��ʵ����ҳ��Ϊ��ǰ·����ָ��༭����Դ�ļ�����dialog���ļ��У���·����
     * ���ںܶ�ͬѧ��ʹ�ñ༭����ʱ����ֵ�����·�����⣬�˴�ǿ�ҽ�����ʹ��"�������վ��Ŀ¼�����·��"�������á�
     * "�������վ��Ŀ¼�����·��"Ҳ������б�ܿ�ͷ������"/myProject/ueditor/"������·����
     * ���վ�����ж������ͬһ�㼶��ҳ����Ҫʵ�����༭������������ͬһUEditor��ʱ�򣬴˴���URL���ܲ�������ÿ��ҳ��ı༭����
     * ��ˣ�UEditor�ṩ����Բ�ͬҳ��ı༭���ɵ������õĸ�·����������˵������Ҫʵ�����༭����ҳ�����д�����´��뼴�ɡ���Ȼ����Ҫ��˴���URL���ڶ�Ӧ�����á�
     * window.UEDITOR_HOME_URL = "/xxxx/xxxx/";
     */
    var URL;

    /**
     * �˴�����д��������UEditorС���Ա����ʹ�ã��ⲿ�����û��밴������˵����ʽ���ü��ɣ����鱣���������У��Լ��ݿ��ھ���ÿ��ҳ������window.UEDITOR_HOME_URL�Ĺ��ܡ�
     */
    var tmp = window.location.pathname;
        URL = window.UEDITOR_HOME_URL||tmp.substr(0,tmp.lastIndexOf("\/")+1).replace("_examples/","").replace("website/","");//������������ó�ueditorĿ¼������վ�����·�����߾���·����ָ��http��ͷ�ľ���·����

    /**
     * ���������塣ע�⣬�˴������漰��·�������ñ���©URL������
     */
    window.UEDITOR_CONFIG = {

        //Ϊ�༭��ʵ�����һ��·����������ܱ�ע��
        UEDITOR_HOME_URL : URL

        //����������,Ĭ����zh-CN������Ҫ�Ļ�Ҳ����ʹ�����������ķ�ʽ���Զ��������л�����Ȼ��ǰ��������lang�ļ����´��ڶ�Ӧ�������ļ���
        //navigator.language||navigator.browserLanguage ||navigator.userLanguage
        //,lang:"zh-CN"
        //,langPath:URL +"lang/"

        //ͼƬ�ϴ�������
        ,imageUrl:""             //ͼƬ�ϴ��ύ��ַ
        ,imagePath:""                     //ͼƬ������ַ��������fixedImagePath,�����������󣬿���������
       //,imageFieldName:"upfile"                   //ͼƬ���ݵ�key,���˴��޸ģ���Ҫ�ں�̨��Ӧ�ļ��޸Ķ�Ӧ����
        ,compressSide:0                            //�ȱ�ѹ���Ļ�׼��ȷ��maxImageSideLength�����Ĳ��ն���0Ϊ������ߣ�1Ϊ���տ�ȣ�2Ϊ���ո߶�
        ,maxImageSideLength:9000                    //�ϴ�ͼƬ�������ı߳����������Զ��ȱ�����,�����ž�����һ���Ƚϴ��ֵ������������image.html��

        //ͿѻͼƬ������
        ,scrawlUrl:""           //Ϳѻ�ϴ���ַ
        ,scrawlPath:""                           //ͼƬ������ַ��ͬimagePath

        //�����ϴ�������
        ,fileUrl:""             //�����ϴ��ύ��ַ
        ,filePath:""                  //����������ַ��ͬimagePath
        //,fileFieldName:"upfile"                    //�����ύ�ı��������˴��޸ģ���Ҫ�ں�̨��Ӧ�ļ��޸Ķ�Ӧ����

         //Զ��ץȡ������
        ,catchRemoteImageEnable:true               //�Ƿ���Զ��ͼƬץȡ,Ĭ�Ͽ���
        ,catcherUrl:""   //����Զ��ͼƬץȡ�ĵ�ַ
        ,catcherPath:""                  //ͼƬ������ַ��ͬimagePath
        //,catchFieldName:"upfile"                   //�ύ����̨Զ��ͼƬuri�ϼ������˴��޸ģ���Ҫ�ں�̨��Ӧ�ļ��޸Ķ�Ӧ����
        //,separater:'ue_separate_ue'               //�ύ����̨��Զ��ͼƬ��ַ�ַ����ָ���
        ,localDomain:[]                            //���ض���������������Զ��ͼƬץȡʱ������֮����������������µ�ͼƬ������ץȡ������,Ĭ�ϲ�ץȡ127.0.0.1��localhost

        //ͼƬ���߹���������
        ,imageManagerUrl:""       //ͼƬ���߹���Ĵ����ַ
        ,imageManagerPath:""                                    //ͼƬ������ַ��ͬimagePath

        //��Ļ��ͼ������
        //,snapscreenHost: '127.0.0.1'                                  //��Ļ��ͼ��server���ļ����ڵ���վ��ַ����ip���벻Ҫ��http://
        //,snapscreenServerUrl: URL +"php/imageUp.php" //��Ļ��ͼ��server�˱������UEditor�ķ�������Ϊ��URL +"server/upload/php/snapImgUp.php"��
        //,snapscreenPath: URL + "php/"
        //,snapscreenServerPort: 80                                    //��Ļ��ͼ��server�˶˿�
        //,snapscreenImgAlign: 'center'                                //��ͼ��ͼƬĬ�ϵ��Ű淽ʽ

        //wordת��������
        ,wordImageUrl:""             //wordת���ύ��ַ
        ,wordImagePath:""                       //
        //,wordImageFieldName:"upfile"                     //wordת��������˴��޸ģ���Ҫ�ں�̨��Ӧ�ļ��޸Ķ�Ӧ����

        //��ȡ��Ƶ���ݵĵ�ַ
        ,getMovieUrl:URL+"php/getMovie.php"                   //��Ƶ���ݻ�ȡ��ַ

        //�������ϵ����еĹ��ܰ�ť�������򣬿�����new�༭����ʵ��ʱѡ���Լ���Ҫ�Ĵ��¶���
        ,toolbars:[["source","bold","italic","underline","forecolor","justifyleft","justifycenter","justifyright","justifyjustify","undo","redo","insertunorderedlist","insertorderedlist","unlink","link","cleardoc","selectall","print","searchreplace","preview"]]
        //�������ڹ�������ʱ��ʾ��tooltip��ʾ,����֧���Զ����������ã�����������ֵΪ׼
        ,labelMap:{
            'subtitle':'�ӱ���'
        }
        //webAppKey
        //�ٶ�Ӧ�õ�APIkey��ÿ��վ����������ȥ�ٶȹ���ע��һ��key��������ʹ��app����  ʢŭ�����������
        ,webAppKey:"5r7SmiUici27lVfVBep1K7BA"


        //��ʵ�����༭����ҳ���ֶ��޸ĵ�domain���˴���Ҫ����Ϊtrue
        //,customDomain:false

        //���getAllHtml���������ڶ�Ӧ��head��ǩ�����Ӹñ������á�
        //,charset:"utf-8"

        //����������Ŀ
        //,isShow : true    //Ĭ����ʾ�༭��

        ,initialContent:''    //��ʼ���༭��������,Ҳ����ͨ��textarea/script��ֵ������������

        //,autoClearinitialContent:true //�Ƿ��Զ�����༭����ʼ���ݣ�ע�⣺���focus��������Ϊtrue,���ҲΪ�棬��ô�༭��һ�����ͻᴥ�����³�ʼ�������ݿ�������

        //,iframeCssUrl: URL + '/themes/default/iframe.css' //���༭���ڲ�����һ��css�ļ�

        //,textarea:'editorValue' // �ύ��ʱ����������ȡ�༭���ύ���ݵ����õĲ�������ʵ��ʱ���Ը�����name���ԣ��Ὣname������ֵ��Ϊÿ��ʵ���ļ�ֵ������ÿ��ʵ������ʱ���������ֵ

        //,focus:false //��ʼ��ʱ���Ƿ��ñ༭����ý���true��false

        //,minFrameHeight:320  // ��С�߶�,Ĭ��320

        //,autoClearEmptyNode : true //getContentʱ���Ƿ�ɾ���յ�inlineElement�ڵ㣨����Ƕ�׵������

        //,fullscreen : false //�Ƿ�����ʼ��ʱ��ȫ����Ĭ�Ϲر�

        //,readonly : false /�༭����ʼ��������,�༭�����Ƿ���ֻ���ģ�Ĭ����false

        //,zIndex : 900     //�༭���㼶�Ļ���,Ĭ����900

        //,imagePopup:true      //ͼƬ�����ĸ��㿪�أ�Ĭ�ϴ�

        //,initialStyle:'body{font-size:18px}'   //�༭���ڲ���ʽ,���������ı������

        //,emotionLocalization:false //�Ƿ������鱾�ػ���Ĭ�Ϲرա���Ҫ������ȷ��emotion�ļ����°��������ṩ��images�����ļ���

        //,pasteplain:true  //�Ƿ��ı�ճ����falseΪ��ʹ�ô��ı�ճ����trueΪʹ�ô��ı�ճ��

        //,allHtmlEnabled:false //�ύ����̨�������Ƿ��������html�ַ���
        //iframeUrlMap
        //dialog���ݵ�·�� ���ᱻ�滻��URL,������һ���򿪣����������е�dialog��Ĭ��·��
        ,iframeUrlMap:{
            'anchor':'~/dialogs/anchor/anchor.html',
            'insertimage':'',
            'inserttable':'~/dialogs/table/table.html',
            'link':'~/dialogs/link/link.html',
            'spechars':'~/dialogs/spechars/spechars.html',
            'searchreplace':'~/dialogs/searchreplace/searchreplace.html',
            'map':'~/dialogs/map/map.html',
            'gmap':'~/dialogs/gmap/gmap.html',
            'insertvideo':'~/dialogs/video/video.html',
            'help':'~/dialogs/help/help.html',
            'highlightcode':'~/dialogs/highlightcode/highlightcode.html',
            'emotion':'~/dialogs/emotion/emotion.html',
            'wordimage':'',
            'attachment':'',
            'insertframe':'~/dialogs/insertframe/insertframe.html',
            'edittd':'~/dialogs/table/edittd.html',
            'webapp':'~/dialogs/webapp/webapp.html',
            'snapscreen':'~/dialogs/snapscreen/snapscreen.html',
            'scrawl':'~/dialogs/scrawl/scrawl.html',
            'template':'~/dialogs/template/template.html',
            'background':'~/dialogs/background/background.html',
            'subtitle':'~/dialogs/subtitle/subtitle.html'
        }

        //insertorderedlist
        //�����б����������,ֵ����ʱ֧�ֶ������Զ�ʶ��������ֵ�����Դ�ֵΪ׼
//        ,'insertorderedlist':{
//             'decimal' : '' ,         //'1,2,3...'
//             'lower-alpha' : '' ,    // 'a,b,c...'
//             'lower-roman' : '' ,    //'i,ii,iii...'
//             'upper-alpha' : '' ,    //'A,B,C'
//             'upper-roman' : ''      //'I,II,III...'
//        }

        //insertunorderedlist
        //�����б���������ã�ֵ����ʱ֧�ֶ������Զ�ʶ��������ֵ�����Դ�ֵΪ׼
        //,insertunorderedlist : {
        //    'circle' : '',  // '�� СԲȦ'
        //    'disc' : '',    // '�� СԲ��'
        //    'square' : ''   //'�� С����'
        //}

        //fontfamily
        //�������� label����֧�ֶ������Զ��л��������ã���������ֵΪ׼
//        ,'fontfamily':[
//            { label:'',name:'songti',val:'����,SimSun'},
//            { label:'',name:'kaiti',val:'����,����_GB2312, SimKai'},
//            { label:'',name:'yahei',val:'΢���ź�,Microsoft YaHei'},
//            { label:'',name:'heiti',val:'����, SimHei'},
//            { label:'',name:'lishu',val:'����, SimLi'},
//            { label:'',name:'andaleMono',val:'andale mono'},
//            { label:'',name:'arial',val:'arial, helvetica,sans-serif'},
//            { label:'',name:'arialBlack',val:'arial black,avant garde'},
//            { label:'',name:'comicSansMs',val:'comic sans ms'},
//            { label:'',name:'impact',val:'impact,chicago'},
//            { label:'',name:'timesNewRoman',val:'times new roman'}
//          ]

        //fontsize
        //�ֺ�
        //,'fontsize':[10, 11, 12, 14, 16, 18, 20, 24, 36]

        //paragraph
        //�����ʽ ֵ����ʱ֧�ֶ������Զ�ʶ�������ã���������ֵΪ׼
        //,'paragraph':{'p':'', 'h1':'', 'h2':'', 'h3':'', 'h4':'', 'h5':'', 'h6':''}

        //rowspacingtop
        //�μ�� ֵ����ʾ��������ͬ
        //,'rowspacingtop':['5', '10', '15', '20', '25']

        //rowspacingBottom
        //�μ�� ֵ����ʾ��������ͬ
        //,'rowspacingbottom':['5', '10', '15', '20', '25']

        //lineheight
        //���ڼ�� ֵ����ʾ��������ͬ
        //,'lineheight':['1', '1.5','1.75','2', '3', '4', '5']

        //customstyle
        //�Զ�����ʽ����֧�ֹ��ʻ����˴�����ֵ���������ʾֵ
        //block��Ԫ�����������ö�����߼����õģ�inline��Ԫ������BIU���߼�����
        //����ʹ��һЩ���õı�ǩ
        //����˵��
        //tag ʹ�õı�ǩ����
        //label ��ʾ������Ҳ��������ʶ��ͬ���͵ı�ʶ����ע�����ֵÿ��Ҫ��ͬ��
        //style ��ӵ���ʽ
        //ÿһ���������һ���Զ������ʽ
        //,'customstyle':[
        //      {tag:'h1', name:'tc', label:'���б���', style:'border-bottom:#ccc 2px solid;padding:0 4px 0 0;text-align:center;margin:0 0 20px 0;'},
        //      {tag:'h1', name:'tl',label:'�������', style:'border-bottom:#ccc 2px solid;padding:0 4px 0 0;margin:0 0 10px 0;'},
        //      {tag:'span',name:'im', label:'ǿ��', style:'font-style:italic;font-weight:bold;color:#000'},
        //      {tag:'span',name:'hi', label:'����ǿ��', style:'font-style:italic;font-weight:bold;color:rgb(51, 153, 204)'}
        //  ]

        //�Ҽ��˵������ݣ����Բο�plugins/contextmenu.js��ߵ�Ĭ�ϲ˵������ӣ�label����֧�ֹ��ʻ��������Դ�����Ϊ׼
//        ,contextMenu:[
//            {
//                label:'',       //��ʾ������
//                cmdName:'selectall',//ִ�е�command������������Ҽ��˵�ʱ
//                //exec��ѡ������exec�ͻ��ڵ��ʱִ�����function�����ȼ�����cmdName
//                exec:function () {
//                    //this�ǵ�ǰ�༭����ʵ��
//                    //this.ui._dialogs['inserttableDialog'].open();
//                }
//            }
//           ]

        //wordCount
        //,wordCount:false          //�Ƿ�������ͳ��
        //,maximumWords:10000       //���������ַ���
        //����ͳ����ʾ��{#count}����ǰ������{#leave}����������������ַ���,����֧�ֶ������Զ��л������򰴴�������ʾ
        //,wordCountMsg:''   //��ǰ������ {#count} ���ַ���������������{#leave} ���ַ�
        //��������������ʾ  ����֧�ֶ������Զ��л������򰴴�������ʾ
        //,wordOverFlowMsg:''    //<span style="color:red;">��������ַ������Ѿ������������ֵ�����������ܻ�ܾ����棡</span>

        //highlightcode
        // �������ʱ��Ҫ���صĵ����������·��
        // ,highlightJsUrl:URL + "third-party/SyntaxHighlighter/shCore.js"
        // ,highlightCssUrl:URL + "third-party/SyntaxHighlighter/shCoreDefault.css"

        //tab
        //���tab��ʱ�ƶ��ľ���,tabSize������tabNodeʲô�ַ���Ϊ��λ
        //,tabSize:4
        //,tabNode:'&nbsp;'

        //elementPathEnabled
        //�Ƿ�����Ԫ��·����Ĭ������ʾ
        //,elementPathEnabled : false

        //removeFormat
        //�����ʽʱ����ɾ���ı�ǩ������
        //removeForamtTags��ǩ
        //,removeFormatTags:'b,big,code,del,dfn,em,font,i,ins,kbd,q,samp,small,span,strike,strong,sub,sup,tt,u,var'
        //removeFormatAttributes����
        //,removeFormatAttributes:'class,style,lang,width,height,align,hspace,valign'

         //undo
         //���������˵Ĵ���,Ĭ��20
         //,maxUndoCount:20
         //��������ַ���������ֵʱ������һ���ֳ�
         //,maxInputCount:1

        //autoHeightEnabled
        // �Ƿ��Զ�����,Ĭ��true
        ,autoHeightEnabled:false

        //autoFloatEnabled
        //�Ƿ񱣳�toolbar��λ�ò���,Ĭ��true
        //,autoFloatEnabled:true
        //����ʱ��������������������ĸ߶ȣ�����ĳЩ���й̶�ͷ����ҳ��
        //,topOffset:30

        //indentValue
        //������������,Ĭ����2em
        //,indentValue:'2em'

        //pageBreakTag
        //��ҳ��ʶ��,Ĭ����_baidu_page_break_tag_
        ,pageBreakTag:'[page]'

        //sourceEditor
        //Դ��Ĳ鿴��ʽ,codemirror �Ǵ��������textarea���ı���,Ĭ����codemirror
        //,sourceEditor:"codemirror"
        //���sourceEditor��codemirror����������һ����������
        //codeMirrorJsUrl js���ص�·����Ĭ���� URL + "third-party/codemirror2.15/codemirror.js"
        //,codeMirrorJsUrl:URL + "third-party/codemirror2.15/codemirror.js"
        //codeMirrorCssUrl css���ص�·����Ĭ���� URL + "third-party/codemirror2.15/codemirror.css"
        //,codeMirrorCssUrl:URL + "third-party/codemirror2.15/codemirror.css"
        //�༭����ʼ����ɺ��Ƿ����Դ��ģʽ��Ĭ��Ϊ��
        //,sourceEditorFirst:false

        //serialize
        // ���ñ༭���Ĺ��˹���
        // serialize�Ǹ�object,����������blackList��whiteList���ԣ�Ĭ����{}
        // ����:
//        , serialize : {
//              //���������༭������˵�һ�±�ǩ
//              blackList:{object:1, applet:1, input:1, meta:1, base:1, button:1, select:1, textarea:1, '#comment':1, 'map':1, 'area':1}
//        }


        //autotypeset
        //  //�Զ��Ű����
        //  ,autotypeset:{
        //      mergeEmptyline : true,         //�ϲ�����
        //      removeClass : true,           //ȥ�������class
        //      removeEmptyline : false,      //ȥ������
        //      textAlign : "left" ,           //������Ű淽ʽ�������� left,right,center,justify ȥ��������Ա�ʾ��ִ���Ű�
        //      imageBlockLine : 'center',      //ͼƬ�ĸ�����ʽ����ռһ�о���,���Ҹ�����Ĭ��: center,left,right,none ȥ��������Ա�ʾ��ִ���Ű�
        //      pasteFilter : false,            //���ݹ������û��ճ������������
        //      clearFontSize : false,          //ȥ�����е���Ƕ�ֺţ�ʹ�ñ༭��Ĭ�ϵ��ֺ�
        //      clearFontFamily : false,        //ȥ�����е���Ƕ���壬ʹ�ñ༭��Ĭ�ϵ�����
        //      removeEmptyNode : false ,       // ȥ���սڵ�
        //      //����ȥ���ı�ǩ
        //      removeTagNames : {��ǩ����:1},
        //      indent : false,                 // ��������
        //      indentValue : '2em'             //���������Ĵ�С
        //  }
    };
})();
