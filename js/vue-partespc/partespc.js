// Components
new Vue({
    el: '#partesPC',
    data: {
        title: 'PARTES DE PC',
        num1: 0,
        num2: 0,
        total: 0,
        items:[
            {id:1, desc:'obj1', val:50},
            {id:2, desc:'obj2', val:60},
            {id:3, desc:'obj3', val:70},
            {id:4, desc:'obj4', val:80},
            {id:5, desc:'obj5', val:90},
            {id:6, desc:'obj6', val:100},
            {id:7, desc:'obj7', val:110},
            {id:8, desc:'obj8', val:120},
            {id:9, desc:'obj9', val:130},
            {id:10, desc:'obj10', val:140},
            {id:11, desc:'obj11', val:150},
            {id:12, desc:'obj12', val:160},
            {id:13, desc:'obj13', val:170},
            {id:14, desc:'obj14', val:180}
        ],
        itemSel:[]
    },
    methods: {
        ver: function(){
            // this.total = parseInt(this.num1) + parseInt(this.num2);
            console.log(this.itemSel)
        }
    }
});