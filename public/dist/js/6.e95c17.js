(window.webpackJsonp=window.webpackJsonp||[]).push([[6],{23:function(t,e,r){"use strict";r.d(e,"a",(function(){return n}));var n=function(t){return t=t.toString(),isNaN(parseFloat(t.replace(/,/g,"")))?"0":parseFloat(t.replace(/,/g,"")).toFixed().replace(/\B(?=(\d{3})+(?!\d))/g,".")}},39:function(t,e,r){"use strict";var n={MODE_NUMBER:1,MODE_ALPHA_NUM:2,MODE_8BIT_BYTE:4,MODE_KANJI:8};function o(t){this.mode=n.MODE_8BIT_BYTE,this.data=t}o.prototype={getLength:function(t){return this.data.length},write:function(t){for(var e=0;e<this.data.length;e++)t.put(this.data.charCodeAt(e),8)}};var i=o,a={L:1,M:0,Q:3,H:2};function s(t,e){this.totalCount=t,this.dataCount=e}s.RS_BLOCK_TABLE=[[1,26,19],[1,26,16],[1,26,13],[1,26,9],[1,44,34],[1,44,28],[1,44,22],[1,44,16],[1,70,55],[1,70,44],[2,35,17],[2,35,13],[1,100,80],[2,50,32],[2,50,24],[4,25,9],[1,134,108],[2,67,43],[2,33,15,2,34,16],[2,33,11,2,34,12],[2,86,68],[4,43,27],[4,43,19],[4,43,15],[2,98,78],[4,49,31],[2,32,14,4,33,15],[4,39,13,1,40,14],[2,121,97],[2,60,38,2,61,39],[4,40,18,2,41,19],[4,40,14,2,41,15],[2,146,116],[3,58,36,2,59,37],[4,36,16,4,37,17],[4,36,12,4,37,13],[2,86,68,2,87,69],[4,69,43,1,70,44],[6,43,19,2,44,20],[6,43,15,2,44,16],[4,101,81],[1,80,50,4,81,51],[4,50,22,4,51,23],[3,36,12,8,37,13],[2,116,92,2,117,93],[6,58,36,2,59,37],[4,46,20,6,47,21],[7,42,14,4,43,15],[4,133,107],[8,59,37,1,60,38],[8,44,20,4,45,21],[12,33,11,4,34,12],[3,145,115,1,146,116],[4,64,40,5,65,41],[11,36,16,5,37,17],[11,36,12,5,37,13],[5,109,87,1,110,88],[5,65,41,5,66,42],[5,54,24,7,55,25],[11,36,12],[5,122,98,1,123,99],[7,73,45,3,74,46],[15,43,19,2,44,20],[3,45,15,13,46,16],[1,135,107,5,136,108],[10,74,46,1,75,47],[1,50,22,15,51,23],[2,42,14,17,43,15],[5,150,120,1,151,121],[9,69,43,4,70,44],[17,50,22,1,51,23],[2,42,14,19,43,15],[3,141,113,4,142,114],[3,70,44,11,71,45],[17,47,21,4,48,22],[9,39,13,16,40,14],[3,135,107,5,136,108],[3,67,41,13,68,42],[15,54,24,5,55,25],[15,43,15,10,44,16],[4,144,116,4,145,117],[17,68,42],[17,50,22,6,51,23],[19,46,16,6,47,17],[2,139,111,7,140,112],[17,74,46],[7,54,24,16,55,25],[34,37,13],[4,151,121,5,152,122],[4,75,47,14,76,48],[11,54,24,14,55,25],[16,45,15,14,46,16],[6,147,117,4,148,118],[6,73,45,14,74,46],[11,54,24,16,55,25],[30,46,16,2,47,17],[8,132,106,4,133,107],[8,75,47,13,76,48],[7,54,24,22,55,25],[22,45,15,13,46,16],[10,142,114,2,143,115],[19,74,46,4,75,47],[28,50,22,6,51,23],[33,46,16,4,47,17],[8,152,122,4,153,123],[22,73,45,3,74,46],[8,53,23,26,54,24],[12,45,15,28,46,16],[3,147,117,10,148,118],[3,73,45,23,74,46],[4,54,24,31,55,25],[11,45,15,31,46,16],[7,146,116,7,147,117],[21,73,45,7,74,46],[1,53,23,37,54,24],[19,45,15,26,46,16],[5,145,115,10,146,116],[19,75,47,10,76,48],[15,54,24,25,55,25],[23,45,15,25,46,16],[13,145,115,3,146,116],[2,74,46,29,75,47],[42,54,24,1,55,25],[23,45,15,28,46,16],[17,145,115],[10,74,46,23,75,47],[10,54,24,35,55,25],[19,45,15,35,46,16],[17,145,115,1,146,116],[14,74,46,21,75,47],[29,54,24,19,55,25],[11,45,15,46,46,16],[13,145,115,6,146,116],[14,74,46,23,75,47],[44,54,24,7,55,25],[59,46,16,1,47,17],[12,151,121,7,152,122],[12,75,47,26,76,48],[39,54,24,14,55,25],[22,45,15,41,46,16],[6,151,121,14,152,122],[6,75,47,34,76,48],[46,54,24,10,55,25],[2,45,15,64,46,16],[17,152,122,4,153,123],[29,74,46,14,75,47],[49,54,24,10,55,25],[24,45,15,46,46,16],[4,152,122,18,153,123],[13,74,46,32,75,47],[48,54,24,14,55,25],[42,45,15,32,46,16],[20,147,117,4,148,118],[40,75,47,7,76,48],[43,54,24,22,55,25],[10,45,15,67,46,16],[19,148,118,6,149,119],[18,75,47,31,76,48],[34,54,24,34,55,25],[20,45,15,61,46,16]],s.getRSBlocks=function(t,e){var r=s.getRsBlockTable(t,e);if(null==r)throw new Error("bad rs block @ typeNumber:"+t+"/errorCorrectLevel:"+e);for(var n=r.length/3,o=new Array,i=0;i<n;i++)for(var a=r[3*i+0],u=r[3*i+1],l=r[3*i+2],h=0;h<a;h++)o.push(new s(u,l));return o},s.getRsBlockTable=function(t,e){switch(e){case a.L:return s.RS_BLOCK_TABLE[4*(t-1)+0];case a.M:return s.RS_BLOCK_TABLE[4*(t-1)+1];case a.Q:return s.RS_BLOCK_TABLE[4*(t-1)+2];case a.H:return s.RS_BLOCK_TABLE[4*(t-1)+3];default:return}};var u=s;function l(){this.buffer=new Array,this.length=0}l.prototype={get:function(t){var e=Math.floor(t/8);return 1==(this.buffer[e]>>>7-t%8&1)},put:function(t,e){for(var r=0;r<e;r++)this.putBit(1==(t>>>e-r-1&1))},getLengthInBits:function(){return this.length},putBit:function(t){var e=Math.floor(this.length/8);this.buffer.length<=e&&this.buffer.push(0),t&&(this.buffer[e]|=128>>>this.length%8),this.length++}};for(var h=l,c={glog:function(t){if(t<1)throw new Error("glog("+t+")");return c.LOG_TABLE[t]},gexp:function(t){for(;t<0;)t+=255;for(;t>=256;)t-=255;return c.EXP_TABLE[t]},EXP_TABLE:new Array(256),LOG_TABLE:new Array(256)},f=0;f<8;f++)c.EXP_TABLE[f]=1<<f;for(f=8;f<256;f++)c.EXP_TABLE[f]=c.EXP_TABLE[f-4]^c.EXP_TABLE[f-5]^c.EXP_TABLE[f-6]^c.EXP_TABLE[f-8];for(f=0;f<255;f++)c.LOG_TABLE[c.EXP_TABLE[f]]=f;var d=c;function g(t,e){if(null==t.length)throw new Error(t.length+"/"+e);for(var r=0;r<t.length&&0==t[r];)r++;this.num=new Array(t.length-r+e);for(var n=0;n<t.length-r;n++)this.num[n]=t[n+r]}g.prototype={get:function(t){return this.num[t]},getLength:function(){return this.num.length},multiply:function(t){for(var e=new Array(this.getLength()+t.getLength()-1),r=0;r<this.getLength();r++)for(var n=0;n<t.getLength();n++)e[r+n]^=d.gexp(d.glog(this.get(r))+d.glog(t.get(n)));return new g(e,0)},mod:function(t){if(this.getLength()-t.getLength()<0)return this;for(var e=d.glog(this.get(0))-d.glog(t.get(0)),r=new Array(this.getLength()),n=0;n<this.getLength();n++)r[n]=this.get(n);for(n=0;n<t.getLength();n++)r[n]^=d.gexp(d.glog(t.get(n))+e);return new g(r,0).mod(t)}};var p=g,v=0,m=1,_=2,C=3,y=4,w=5,D=6,b=7,E={PATTERN_POSITION_TABLE:[[],[6,18],[6,22],[6,26],[6,30],[6,34],[6,22,38],[6,24,42],[6,26,46],[6,28,50],[6,30,54],[6,32,58],[6,34,62],[6,26,46,66],[6,26,48,70],[6,26,50,74],[6,30,54,78],[6,30,56,82],[6,30,58,86],[6,34,62,90],[6,28,50,72,94],[6,26,50,74,98],[6,30,54,78,102],[6,28,54,80,106],[6,32,58,84,110],[6,30,58,86,114],[6,34,62,90,118],[6,26,50,74,98,122],[6,30,54,78,102,126],[6,26,52,78,104,130],[6,30,56,82,108,134],[6,34,60,86,112,138],[6,30,58,86,114,142],[6,34,62,90,118,146],[6,30,54,78,102,126,150],[6,24,50,76,102,128,154],[6,28,54,80,106,132,158],[6,32,58,84,110,136,162],[6,26,54,82,110,138,166],[6,30,58,86,114,142,170]],G15:1335,G18:7973,G15_MASK:21522,getBCHTypeInfo:function(t){for(var e=t<<10;E.getBCHDigit(e)-E.getBCHDigit(E.G15)>=0;)e^=E.G15<<E.getBCHDigit(e)-E.getBCHDigit(E.G15);return(t<<10|e)^E.G15_MASK},getBCHTypeNumber:function(t){for(var e=t<<12;E.getBCHDigit(e)-E.getBCHDigit(E.G18)>=0;)e^=E.G18<<E.getBCHDigit(e)-E.getBCHDigit(E.G18);return t<<12|e},getBCHDigit:function(t){for(var e=0;0!=t;)e++,t>>>=1;return e},getPatternPosition:function(t){return E.PATTERN_POSITION_TABLE[t-1]},getMask:function(t,e,r){switch(t){case v:return(e+r)%2==0;case m:return e%2==0;case _:return r%3==0;case C:return(e+r)%3==0;case y:return(Math.floor(e/2)+Math.floor(r/3))%2==0;case w:return e*r%2+e*r%3==0;case D:return(e*r%2+e*r%3)%2==0;case b:return(e*r%3+(e+r)%2)%2==0;default:throw new Error("bad maskPattern:"+t)}},getErrorCorrectPolynomial:function(t){for(var e=new p([1],0),r=0;r<t;r++)e=e.multiply(new p([1,d.gexp(r)],0));return e},getLengthInBits:function(t,e){if(1<=e&&e<10)switch(t){case n.MODE_NUMBER:return 10;case n.MODE_ALPHA_NUM:return 9;case n.MODE_8BIT_BYTE:case n.MODE_KANJI:return 8;default:throw new Error("mode:"+t)}else if(e<27)switch(t){case n.MODE_NUMBER:return 12;case n.MODE_ALPHA_NUM:return 11;case n.MODE_8BIT_BYTE:return 16;case n.MODE_KANJI:return 10;default:throw new Error("mode:"+t)}else{if(!(e<41))throw new Error("type:"+e);switch(t){case n.MODE_NUMBER:return 14;case n.MODE_ALPHA_NUM:return 13;case n.MODE_8BIT_BYTE:return 16;case n.MODE_KANJI:return 12;default:throw new Error("mode:"+t)}}},getLostPoint:function(t){for(var e=t.getModuleCount(),r=0,n=0;n<e;n++)for(var o=0;o<e;o++){for(var i=0,a=t.isDark(n,o),s=-1;s<=1;s++)if(!(n+s<0||e<=n+s))for(var u=-1;u<=1;u++)o+u<0||e<=o+u||0==s&&0==u||a==t.isDark(n+s,o+u)&&i++;i>5&&(r+=3+i-5)}for(n=0;n<e-1;n++)for(o=0;o<e-1;o++){var l=0;t.isDark(n,o)&&l++,t.isDark(n+1,o)&&l++,t.isDark(n,o+1)&&l++,t.isDark(n+1,o+1)&&l++,0!=l&&4!=l||(r+=3)}for(n=0;n<e;n++)for(o=0;o<e-6;o++)t.isDark(n,o)&&!t.isDark(n,o+1)&&t.isDark(n,o+2)&&t.isDark(n,o+3)&&t.isDark(n,o+4)&&!t.isDark(n,o+5)&&t.isDark(n,o+6)&&(r+=40);for(o=0;o<e;o++)for(n=0;n<e-6;n++)t.isDark(n,o)&&!t.isDark(n+1,o)&&t.isDark(n+2,o)&&t.isDark(n+3,o)&&t.isDark(n+4,o)&&!t.isDark(n+5,o)&&t.isDark(n+6,o)&&(r+=40);var h=0;for(o=0;o<e;o++)for(n=0;n<e;n++)t.isDark(n,o)&&h++;return r+=10*(Math.abs(100*h/e/e-50)/5)}},B=E;function L(t,e){this.typeNumber=t,this.errorCorrectLevel=e,this.modules=null,this.moduleCount=0,this.dataCache=null,this.dataList=[]}var P=L.prototype;P.addData=function(t){var e=new i(t);this.dataList.push(e),this.dataCache=null},P.isDark=function(t,e){if(t<0||this.moduleCount<=t||e<0||this.moduleCount<=e)throw new Error(t+","+e);return this.modules[t][e]},P.getModuleCount=function(){return this.moduleCount},P.make=function(){if(this.typeNumber<1){var t=1;for(t=1;t<40;t++){for(var e=u.getRSBlocks(t,this.errorCorrectLevel),r=new h,n=0,o=0;o<e.length;o++)n+=e[o].dataCount;for(o=0;o<this.dataList.length;o++){var i=this.dataList[o];r.put(i.mode,4),r.put(i.getLength(),B.getLengthInBits(i.mode,t)),i.write(r)}if(r.getLengthInBits()<=8*n)break}this.typeNumber=t}this.makeImpl(!1,this.getBestMaskPattern())},P.makeImpl=function(t,e){this.moduleCount=4*this.typeNumber+17,this.modules=new Array(this.moduleCount);for(var r=0;r<this.moduleCount;r++){this.modules[r]=new Array(this.moduleCount);for(var n=0;n<this.moduleCount;n++)this.modules[r][n]=null}this.setupPositionProbePattern(0,0),this.setupPositionProbePattern(this.moduleCount-7,0),this.setupPositionProbePattern(0,this.moduleCount-7),this.setupPositionAdjustPattern(),this.setupTimingPattern(),this.setupTypeInfo(t,e),this.typeNumber>=7&&this.setupTypeNumber(t),null==this.dataCache&&(this.dataCache=L.createData(this.typeNumber,this.errorCorrectLevel,this.dataList)),this.mapData(this.dataCache,e)},P.setupPositionProbePattern=function(t,e){for(var r=-1;r<=7;r++)if(!(t+r<=-1||this.moduleCount<=t+r))for(var n=-1;n<=7;n++)e+n<=-1||this.moduleCount<=e+n||(this.modules[t+r][e+n]=0<=r&&r<=6&&(0==n||6==n)||0<=n&&n<=6&&(0==r||6==r)||2<=r&&r<=4&&2<=n&&n<=4)},P.getBestMaskPattern=function(){for(var t=0,e=0,r=0;r<8;r++){this.makeImpl(!0,r);var n=B.getLostPoint(this);(0==r||t>n)&&(t=n,e=r)}return e},P.createMovieClip=function(t,e,r){var n=t.createEmptyMovieClip(e,r);this.make();for(var o=0;o<this.modules.length;o++)for(var i=1*o,a=0;a<this.modules[o].length;a++){var s=1*a;this.modules[o][a]&&(n.beginFill(0,100),n.moveTo(s,i),n.lineTo(s+1,i),n.lineTo(s+1,i+1),n.lineTo(s,i+1),n.endFill())}return n},P.setupTimingPattern=function(){for(var t=8;t<this.moduleCount-8;t++)null==this.modules[t][6]&&(this.modules[t][6]=t%2==0);for(var e=8;e<this.moduleCount-8;e++)null==this.modules[6][e]&&(this.modules[6][e]=e%2==0)},P.setupPositionAdjustPattern=function(){for(var t=B.getPatternPosition(this.typeNumber),e=0;e<t.length;e++)for(var r=0;r<t.length;r++){var n=t[e],o=t[r];if(null==this.modules[n][o])for(var i=-2;i<=2;i++)for(var a=-2;a<=2;a++)this.modules[n+i][o+a]=-2==i||2==i||-2==a||2==a||0==i&&0==a}},P.setupTypeNumber=function(t){for(var e=B.getBCHTypeNumber(this.typeNumber),r=0;r<18;r++){var n=!t&&1==(e>>r&1);this.modules[Math.floor(r/3)][r%3+this.moduleCount-8-3]=n}for(r=0;r<18;r++){n=!t&&1==(e>>r&1);this.modules[r%3+this.moduleCount-8-3][Math.floor(r/3)]=n}},P.setupTypeInfo=function(t,e){for(var r=this.errorCorrectLevel<<3|e,n=B.getBCHTypeInfo(r),o=0;o<15;o++){var i=!t&&1==(n>>o&1);o<6?this.modules[o][8]=i:o<8?this.modules[o+1][8]=i:this.modules[this.moduleCount-15+o][8]=i}for(o=0;o<15;o++){i=!t&&1==(n>>o&1);o<8?this.modules[8][this.moduleCount-o-1]=i:o<9?this.modules[8][15-o-1+1]=i:this.modules[8][15-o-1]=i}this.modules[this.moduleCount-8][8]=!t},P.mapData=function(t,e){for(var r=-1,n=this.moduleCount-1,o=7,i=0,a=this.moduleCount-1;a>0;a-=2)for(6==a&&a--;;){for(var s=0;s<2;s++)if(null==this.modules[n][a-s]){var u=!1;i<t.length&&(u=1==(t[i]>>>o&1)),B.getMask(e,n,a-s)&&(u=!u),this.modules[n][a-s]=u,-1==--o&&(i++,o=7)}if((n+=r)<0||this.moduleCount<=n){n-=r,r=-r;break}}},L.PAD0=236,L.PAD1=17,L.createData=function(t,e,r){for(var n=u.getRSBlocks(t,e),o=new h,i=0;i<r.length;i++){var a=r[i];o.put(a.mode,4),o.put(a.getLength(),B.getLengthInBits(a.mode,t)),a.write(o)}var s=0;for(i=0;i<n.length;i++)s+=n[i].dataCount;if(o.getLengthInBits()>8*s)throw new Error("code length overflow. ("+o.getLengthInBits()+">"+8*s+")");for(o.getLengthInBits()+4<=8*s&&o.put(0,4);o.getLengthInBits()%8!=0;)o.putBit(!1);for(;!(o.getLengthInBits()>=8*s||(o.put(L.PAD0,8),o.getLengthInBits()>=8*s));)o.put(L.PAD1,8);return L.createBytes(o,n)},L.createBytes=function(t,e){for(var r=0,n=0,o=0,i=new Array(e.length),a=new Array(e.length),s=0;s<e.length;s++){var u=e[s].dataCount,l=e[s].totalCount-u;n=Math.max(n,u),o=Math.max(o,l),i[s]=new Array(u);for(var h=0;h<i[s].length;h++)i[s][h]=255&t.buffer[h+r];r+=u;var c=B.getErrorCorrectPolynomial(l),f=new p(i[s],c.getLength()-1).mod(c);a[s]=new Array(c.getLength()-1);for(h=0;h<a[s].length;h++){var d=h+f.getLength()-a[s].length;a[s][h]=d>=0?f.get(d):0}}var g=0;for(h=0;h<e.length;h++)g+=e[h].totalCount;var v=new Array(g),m=0;for(h=0;h<n;h++)for(s=0;s<e.length;s++)h<i[s].length&&(v[m++]=i[s][h]);for(h=0;h<o;h++)for(s=0;s<e.length;s++)h<a[s].length&&(v[m++]=a[s][h]);return v};var A=L;var k={props:{value:{type:String,required:!0,default:""},className:{type:String,default:""},size:{type:[Number,String],default:100,validator:function(t){return!0!==isNaN(Number(t))}},level:{type:String,default:"L",validator:function(t){return["L","Q","M","H"].indexOf(t)>-1}},background:{type:String,default:"#fff"},foreground:{type:String,default:"#000"}},updated:function(){this.render()},mounted:function(){this.render()},methods:{render:function(){var t=this.value,e=this.size,r=this.level,n=this.background,o=this.foreground,i=e>>>0,s=new A(-1,a[r]);s.addData(function(t){for(var e="",r=0;r<t.length;r++){var n=t.charCodeAt(r);n<128?e+=String.fromCharCode(n):n<2048?(e+=String.fromCharCode(192|n>>6),e+=String.fromCharCode(128|63&n)):n<55296||n>=57344?(e+=String.fromCharCode(224|n>>12),e+=String.fromCharCode(128|n>>6&63),e+=String.fromCharCode(128|63&n)):(r++,n=65536+((1023&n)<<10|1023&t.charCodeAt(r)),e+=String.fromCharCode(240|n>>18),e+=String.fromCharCode(128|n>>12&63),e+=String.fromCharCode(128|n>>6&63),e+=String.fromCharCode(128|63&n))}return e}(t)),s.make();var u=this.$refs["qrcode-vue"],l=u.getContext("2d"),h=s.modules,c=i/h.length,f=i/h.length,d=window.devicePixelRatio||1;u.height=u.width=i*d,l.scale(d,d),h.forEach((function(t,e){t.forEach((function(t,r){l.fillStyle=t?o:n;var i=Math.ceil((r+1)*c)-Math.floor(r*c),a=Math.ceil((e+1)*f)-Math.floor(e*f);l.fillRect(Math.round(r*c),Math.round(e*f),i,a)}))}))}},render:function(t){var e=this.className,r=this.value,n=this.level,o=this.background,i=this.foreground,a=this.size;return t("div",{class:this.class||e,attrs:{value:r,level:n,background:o,foreground:i}},[t("canvas",{attrs:{height:a,width:a},style:{width:a+"px",height:a+"px"},ref:"qrcode-vue"},[])])}};e.a=k},58:function(t,e,r){"use strict";r.r(e);var n=r(10),o=r(5),i=r(39),a=(r(6),r(23)),s=r(3);function u(t,e){var r=Object.keys(t);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(t);e&&(n=n.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),r.push.apply(r,n)}return r}function l(t,e,r){return e in t?Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}):t[e]=r,t}var h={components:{QrcodeVue:i.a},data:function(){return{id:""}},beforeRouteEnter:function(t,e,r){var o=t.params.id,i=Object(n.a)(o);s.a.dispatch("transaction/fetchTransactionById",i).then((function(){return r((function(t){t.id=o||"",s.a.dispatch("transaction/fetchPaymentInfo",t.transactionDetail.event.eo_id)}))}))},computed:function(t){for(var e=1;e<arguments.length;e++){var r=null!=arguments[e]?arguments[e]:{};e%2?u(r,!0).forEach((function(e){l(t,e,r[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(r)):u(r).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(r,e))}))}return t}({},Object(o.b)({transactionDetail:"transaction/transactionDetail",paymentInfo:"transaction/paymentInfo"}),{url:function(){return window.location.href},size:function(){return window.innerWidth<500?.5*window.innerWidth:250},total:function(){var t=this.countCut;return this.transactionDetail.qty*this.transactionDetail.ticket.price-t},countCut:function(){if(!this.transactionDetail.coupon_id)return 0;var t=parseInt(this.transactionDetail.coupon.max_cut),e=this.transactionDetail.qty*this.transactionDetail.ticket.price*(this.transactionDetail.coupon.rate/100);return 0===t?e:e>t?t:e}}),methods:{decrypt:n.a,currencyFormat:a.a,handleEventUrl:function(){this.$router.push({name:"event.detail",params:{id:this.id}})}}},c=r(1),f=Object(c.a)(h,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",[t.transactionDetail.settled_at?r("div",[r("qrcode-vue",{staticClass:"col-12 px-0 d-flex justify-content-center",staticStyle:{"margin-top":"4%"},attrs:{value:t.url,size:t.size}}),t._v(" "),r("p",{staticClass:"text-center",staticStyle:{"font-size":".7rem"}},[t._v(t._s(t.$t("ticket_guide")))])],1):t._e(),t._v(" "),r("div",{staticClass:"col-12"},[r("div",{staticClass:"col-12 p-0"},[r("p",{staticClass:"m-0"},[t._v(t._s(t.$t("transaction_id")))]),t._v(" "),r("p",[t._v(t._s(t.transactionDetail.id.toUpperCase()))])]),t._v(" "),r("div",{staticClass:"col-12 p-0"},[r("p",[t._v(t._s(t.transactionDetail.event.title)+" - "+t._s(t.transactionDetail.ticket.name))])]),t._v(" "),r("v-divider"),t._v(" "),r("div",{staticClass:"col-12 p-0 d-flex justify-content-between"},[r("span",[r("p",[t._v(t._s(t.$t("ticket_price")))])]),t._v(" "),r("span",[t._v(t._s(t.transactionDetail.qty)+" × "),r("span",{staticClass:"font-weight-bold"},[t._v("Rp "+t._s(t.currencyFormat(t.transactionDetail.ticket.price)))])])]),t._v(" "),t.transactionDetail.coupon?r("div",{staticClass:"col-12 p-0 d-flex justify-content-between"},[r("span",[r("p",[t._v(t._s(t.transactionDetail.coupon.code))])]),t._v(" "),r("span",{staticClass:"font-weight-bold mb-0"},[t._v("- Rp "+t._s(t.currencyFormat(t.countCut)))])]):t._e(),t._v(" "),r("div",{staticClass:"col-12 p-0 d-flex justify-content-between blockquote m-0"},[r("span",[r("p",[t._v(t._s(t.$t("total_payment")))])]),t._v(" "),r("span",[r("p",{staticClass:"font-weight-bold"},[t._v("Rp "+t._s(t.currencyFormat(t.total)))])])]),t._v(" "),t.paymentInfo&&!t.transactionDetail.settled_at?r("div",[r("v-divider"),t._v(" "),r("p",[t._v(t._s(t.$t("please_transfer_to")))]),t._v(" "),r("p",[t._v(t._s(t.paymentInfo.name))]),t._v(" "),r("p",[t._v(t._s(t.paymentInfo.bank)+" - "+t._s(t.paymentInfo.acc_number))])],1):t._e()],1),t._v(" "),r("div",{staticClass:"col-12 fixed-bottom bg-light d-md-none",staticStyle:{"box-shadow":"0px -1px 6px 2px rgba(158,158,158,1)"}},[r("button",{staticClass:"btn col-12 btn-primary",attrs:{type:"button"},on:{click:function(e){return t.handleEventUrl()}}},[t._v(t._s(t.$t("see_event_detail")))])])])}),[],!1,null,null,null);e.default=f.exports}}]);