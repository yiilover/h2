///import core
///commands �����ӱ��⹦��
///commandsName  SubTitle
///commandsTitle  �ӱ���
/**
 * @description �����ӱ��⹦��
 * @author yuyang
 */
UE.plugins['subtitle'] = function () {
    var me = this,
        notBreakTags = ['td'],
		domUtils = UE.dom.domUtils;

    function fillNode(node){
        if(domUtils.isEmptyBlock(node)){
            var firstChild = node.firstChild,tmpNode;

            while(firstChild && firstChild.nodeType == 1 && domUtils.isEmptyBlock(firstChild)){
                tmpNode = firstChild;
                firstChild = firstChild.firstChild;
            }
            !tmpNode && (tmpNode = node);
            domUtils.fillNode(me.document,tmpNode);
        }
    }
    function isHr(node){
        return node && node.nodeType == 1 && node.tagName == 'HR' && node.className == 'subtitle';
    }
    me.commands['subtitle'] = {
        execCommand:function (cmd, name) {
            var range = me.selection.getRange(),hr = me.document.createElement('hr');
            domUtils.setAttributes(hr,{
		'subtitle' : name,
                'class' : 'subtitle',
                noshade:"noshade",
                size:"8",
                title: name ,
                'unselectable' : 'on',
                'style' : 'moz-user-select:none;-khtml-user-select: none;'
            });
    //        domUtils.unselectable(hr);
            //table��������
            var node = domUtils.findParentByTagName(range.startContainer, notBreakTags, true),

                parents = [], pN;
            if (node) {
                switch (node.tagName) {
                    case 'TD':
                        pN = node.parentNode;
                        if (!pN.previousSibling) {
                            var table = domUtils.findParentByTagName(pN, 'table');
                            table.parentNode.insertBefore(hr, table);
                            parents = domUtils.findParents(hr, true);

                        } else {
                            pN.parentNode.insertBefore(hr, pN);
                            parents = domUtils.findParents(hr);

                        }
                        pN = parents[1];
                        if (hr !== pN) {
                            domUtils.breakParent(hr, pN);
                        }
                        domUtils.clearSelectedArr(me.currentSelectedArr);
                        //tableҪ��д��һ����ק
                        me.fireEvent('afteradjusttable',me.document);
                }

            } else {

                if (!range.collapsed) {
                    range.deleteContents();
                    var start = range.startContainer;
                    while ( !domUtils.isBody(start) && domUtils.isBlockElm(start) && domUtils.isEmptyNode(start)) {
                        range.setStartBefore(start).collapse(true);
                        domUtils.remove(start);
                        start = range.startContainer;
                    }

                }
                range.insertNode(hr);

                var pN = hr.parentNode, nextNode;
                while (!domUtils.isBody(pN)) {
                    domUtils.breakParent(hr, pN);
                    nextNode = hr.nextSibling;
                    if (nextNode && domUtils.isEmptyBlock(nextNode)) {
                        domUtils.remove(nextNode);
                    }
                    pN = hr.parentNode;
                }
                nextNode = hr.nextSibling;
                var pre = hr.previousSibling;
                if(isHr(pre)){
                    domUtils.remove(pre);
                }else{
                    pre && fillNode(pre);
                }

                if(!nextNode){
                    var p = me.document.createElement('p');

                    hr.parentNode.appendChild(p);
                    domUtils.fillNode(me.document,p);
                    range.setStart(p,0).collapse(true);
                }else{
                    if(isHr(nextNode)){
                        domUtils.remove(nextNode);
                    }else{
                        fillNode(nextNode);
                    }
                    range.setEndAfter(hr).collapse(false);
                }

                range.select(true);

            }

        },
        queryCommandState:function () {
            return this.highlight ? -1 : 0;
        }
    }
};