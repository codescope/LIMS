/* JavaScript Document */

$(document).ready(function(){
   /* $.tablesorter.addParser({
        id:'getDateAttr',
        is: function(sort){return false;},
 format: function(sort,table,cell,cellIndex){return $(cell).attr('data-date');},
        type:'text'
    });*/
    
    $('table#customers').tablesorter({
        
        sortList: [[0,0]],
        cssAsc: 'sorted asc',
        cssDesc: 'sorted desc',
//       headers: { 3:{sorter:'getDateAttr'}}
        
    });
    
    
});

