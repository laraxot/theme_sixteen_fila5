var Os=Object.defineProperty;var $s=(s,r,a)=>r in s?Os(s,r,{enumerable:!0,configurable:!0,writable:!0,value:a}):s[r]=a;var uo=(s,r,a)=>$s(s,typeof r!="symbol"?r+"":r,a);import{r as Is}from"./leaflet.markercluster-kYRFWcpd.js";const Bs="modulepreload",Zs=function(s){return"/themes/Sixteen/"+s},co={},Rs=function(r,a,h){let u=Promise.resolve();if(a&&a.length>0){let _=function(b){return Promise.all(b.map(k=>Promise.resolve(k).then(y=>({status:"fulfilled",value:y}),y=>({status:"rejected",reason:y}))))};document.getElementsByTagName("link");const f=document.querySelector("meta[property=csp-nonce]"),v=f?.nonce||f?.getAttribute("nonce");u=_(a.map(b=>{if(b=Zs(b),b in co)return;co[b]=!0;const k=b.endsWith(".css"),y=k?'[rel="stylesheet"]':"";if(document.querySelector(`link[href="${b}"]${y}`))return;const S=document.createElement("link");if(S.rel=k?"stylesheet":Bs,k||(S.as="script"),S.crossOrigin="",S.href=b,v&&S.setAttribute("nonce",v),document.head.appendChild(S),k)return new Promise((R,W)=>{S.addEventListener("load",R),S.addEventListener("error",()=>W(new Error(`Unable to preload CSS for ${b}`)))})}))}function p(f){const v=new Event("vite:preloadError",{cancelable:!0});if(v.payload=f,window.dispatchEvent(v),!v.defaultPrevented)throw f}return u.then(f=>{for(const v of f||[])v.status==="rejected"&&p(v.reason);return r().catch(p)})};const Qe=globalThis,Gi=Qe.ShadowRoot&&(Qe.ShadyCSS===void 0||Qe.ShadyCSS.nativeShadow)&&"adoptedStyleSheets"in Document.prototype&&"replace"in CSSStyleSheet.prototype,Vi=Symbol(),po=new WeakMap;let Io=class{constructor(r,a,h){if(this._$cssResult$=!0,h!==Vi)throw Error("CSSResult is not constructable. Use `unsafeCSS` or `css` instead.");this.cssText=r,this.t=a}get styleSheet(){let r=this.o;const a=this.t;if(Gi&&r===void 0){const h=a!==void 0&&a.length===1;h&&(r=po.get(a)),r===void 0&&((this.o=r=new CSSStyleSheet).replaceSync(this.cssText),h&&po.set(a,r))}return r}toString(){return this.cssText}};const Ns=s=>new Io(typeof s=="string"?s:s+"",void 0,Vi),Ds=(s,...r)=>{const a=s.length===1?s[0]:r.reduce((h,u,p)=>h+(f=>{if(f._$cssResult$===!0)return f.cssText;if(typeof f=="number")return f;throw Error("Value passed to 'css' function must be a 'css' function result: "+f+". Use 'unsafeCSS' to pass non-literal values, but take care to ensure page security.")})(u)+s[p+1],s[0]);return new Io(a,s,Vi)},Fs=(s,r)=>{if(Gi)s.adoptedStyleSheets=r.map(a=>a instanceof CSSStyleSheet?a:a.styleSheet);else for(const a of r){const h=document.createElement("style"),u=Qe.litNonce;u!==void 0&&h.setAttribute("nonce",u),h.textContent=a.cssText,s.appendChild(h)}},fo=Gi?s=>s:s=>s instanceof CSSStyleSheet?(r=>{let a="";for(const h of r.cssRules)a+=h.cssText;return Ns(a)})(s):s;const{is:Hs,defineProperty:Us,getOwnPropertyDescriptor:Ws,getOwnPropertyNames:qs,getOwnPropertySymbols:js,getPrototypeOf:Gs}=Object,At=globalThis,mo=At.trustedTypes,Vs=mo?mo.emptyScript:"",Ks=At.reactiveElementPolyfillSupport,we=(s,r)=>s,Hi={toAttribute(s,r){switch(r){case Boolean:s=s?Vs:null;break;case Object:case Array:s=s==null?s:JSON.stringify(s)}return s},fromAttribute(s,r){let a=s;switch(r){case Boolean:a=s!==null;break;case Number:a=s===null?null:Number(s);break;case Object:case Array:try{a=JSON.parse(s)}catch{a=null}}return a}},Bo=(s,r)=>!Hs(s,r),_o={attribute:!0,type:String,converter:Hi,reflect:!1,useDefault:!1,hasChanged:Bo};Symbol.metadata??(Symbol.metadata=Symbol("metadata")),At.litPropertyMetadata??(At.litPropertyMetadata=new WeakMap);let Xt=class extends HTMLElement{static addInitializer(r){this._$Ei(),(this.l??(this.l=[])).push(r)}static get observedAttributes(){return this.finalize(),this._$Eh&&[...this._$Eh.keys()]}static createProperty(r,a=_o){if(a.state&&(a.attribute=!1),this._$Ei(),this.prototype.hasOwnProperty(r)&&((a=Object.create(a)).wrapped=!0),this.elementProperties.set(r,a),!a.noAccessor){const h=Symbol(),u=this.getPropertyDescriptor(r,h,a);u!==void 0&&Us(this.prototype,r,u)}}static getPropertyDescriptor(r,a,h){const{get:u,set:p}=Ws(this.prototype,r)??{get(){return this[a]},set(f){this[a]=f}};return{get:u,set(f){const v=u?.call(this);p?.call(this,f),this.requestUpdate(r,v,h)},configurable:!0,enumerable:!0}}static getPropertyOptions(r){return this.elementProperties.get(r)??_o}static _$Ei(){if(this.hasOwnProperty(we("elementProperties")))return;const r=Gs(this);r.finalize(),r.l!==void 0&&(this.l=[...r.l]),this.elementProperties=new Map(r.elementProperties)}static finalize(){if(this.hasOwnProperty(we("finalized")))return;if(this.finalized=!0,this._$Ei(),this.hasOwnProperty(we("properties"))){const a=this.properties,h=[...qs(a),...js(a)];for(const u of h)this.createProperty(u,a[u])}const r=this[Symbol.metadata];if(r!==null){const a=litPropertyMetadata.get(r);if(a!==void 0)for(const[h,u]of a)this.elementProperties.set(h,u)}this._$Eh=new Map;for(const[a,h]of this.elementProperties){const u=this._$Eu(a,h);u!==void 0&&this._$Eh.set(u,a)}this.elementStyles=this.finalizeStyles(this.styles)}static finalizeStyles(r){const a=[];if(Array.isArray(r)){const h=new Set(r.flat(1/0).reverse());for(const u of h)a.unshift(fo(u))}else r!==void 0&&a.push(fo(r));return a}static _$Eu(r,a){const h=a.attribute;return h===!1?void 0:typeof h=="string"?h:typeof r=="string"?r.toLowerCase():void 0}constructor(){super(),this._$Ep=void 0,this.isUpdatePending=!1,this.hasUpdated=!1,this._$Em=null,this._$Ev()}_$Ev(){this._$ES=new Promise(r=>this.enableUpdating=r),this._$AL=new Map,this._$E_(),this.requestUpdate(),this.constructor.l?.forEach(r=>r(this))}addController(r){(this._$EO??(this._$EO=new Set)).add(r),this.renderRoot!==void 0&&this.isConnected&&r.hostConnected?.()}removeController(r){this._$EO?.delete(r)}_$E_(){const r=new Map,a=this.constructor.elementProperties;for(const h of a.keys())this.hasOwnProperty(h)&&(r.set(h,this[h]),delete this[h]);r.size>0&&(this._$Ep=r)}createRenderRoot(){const r=this.shadowRoot??this.attachShadow(this.constructor.shadowRootOptions);return Fs(r,this.constructor.elementStyles),r}connectedCallback(){this.renderRoot??(this.renderRoot=this.createRenderRoot()),this.enableUpdating(!0),this._$EO?.forEach(r=>r.hostConnected?.())}enableUpdating(r){}disconnectedCallback(){this._$EO?.forEach(r=>r.hostDisconnected?.())}attributeChangedCallback(r,a,h){this._$AK(r,h)}_$ET(r,a){const h=this.constructor.elementProperties.get(r),u=this.constructor._$Eu(r,h);if(u!==void 0&&h.reflect===!0){const p=(h.converter?.toAttribute!==void 0?h.converter:Hi).toAttribute(a,h.type);this._$Em=r,p==null?this.removeAttribute(u):this.setAttribute(u,p),this._$Em=null}}_$AK(r,a){const h=this.constructor,u=h._$Eh.get(r);if(u!==void 0&&this._$Em!==u){const p=h.getPropertyOptions(u),f=typeof p.converter=="function"?{fromAttribute:p.converter}:p.converter?.fromAttribute!==void 0?p.converter:Hi;this._$Em=u;const v=f.fromAttribute(a,p.type);this[u]=v??this._$Ej?.get(u)??v,this._$Em=null}}requestUpdate(r,a,h,u=!1,p){if(r!==void 0){const f=this.constructor;if(u===!1&&(p=this[r]),h??(h=f.getPropertyOptions(r)),!((h.hasChanged??Bo)(p,a)||h.useDefault&&h.reflect&&p===this._$Ej?.get(r)&&!this.hasAttribute(f._$Eu(r,h))))return;this.C(r,a,h)}this.isUpdatePending===!1&&(this._$ES=this._$EP())}C(r,a,{useDefault:h,reflect:u,wrapped:p},f){h&&!(this._$Ej??(this._$Ej=new Map)).has(r)&&(this._$Ej.set(r,f??a??this[r]),p!==!0||f!==void 0)||(this._$AL.has(r)||(this.hasUpdated||h||(a=void 0),this._$AL.set(r,a)),u===!0&&this._$Em!==r&&(this._$Eq??(this._$Eq=new Set)).add(r))}async _$EP(){this.isUpdatePending=!0;try{await this._$ES}catch(a){Promise.reject(a)}const r=this.scheduleUpdate();return r!=null&&await r,!this.isUpdatePending}scheduleUpdate(){return this.performUpdate()}performUpdate(){if(!this.isUpdatePending)return;if(!this.hasUpdated){if(this.renderRoot??(this.renderRoot=this.createRenderRoot()),this._$Ep){for(const[u,p]of this._$Ep)this[u]=p;this._$Ep=void 0}const h=this.constructor.elementProperties;if(h.size>0)for(const[u,p]of h){const{wrapped:f}=p,v=this[u];f!==!0||this._$AL.has(u)||v===void 0||this.C(u,void 0,p,v)}}let r=!1;const a=this._$AL;try{r=this.shouldUpdate(a),r?(this.willUpdate(a),this._$EO?.forEach(h=>h.hostUpdate?.()),this.update(a)):this._$EM()}catch(h){throw r=!1,this._$EM(),h}r&&this._$AE(a)}willUpdate(r){}_$AE(r){this._$EO?.forEach(a=>a.hostUpdated?.()),this.hasUpdated||(this.hasUpdated=!0,this.firstUpdated(r)),this.updated(r)}_$EM(){this._$AL=new Map,this.isUpdatePending=!1}get updateComplete(){return this.getUpdateComplete()}getUpdateComplete(){return this._$ES}shouldUpdate(r){return!0}update(r){this._$Eq&&(this._$Eq=this._$Eq.forEach(a=>this._$ET(a,this[a]))),this._$EM()}updated(r){}firstUpdated(r){}};Xt.elementStyles=[],Xt.shadowRootOptions={mode:"open"},Xt[we("elementProperties")]=new Map,Xt[we("finalized")]=new Map,Ks?.({ReactiveElement:Xt}),(At.reactiveElementVersions??(At.reactiveElementVersions=[])).push("2.1.2");const be=globalThis,go=s=>s,ti=be.trustedTypes,vo=ti?ti.createPolicy("lit-html",{createHTML:s=>s}):void 0,Zo="$lit$",Ct=`lit$${Math.random().toFixed(9).slice(2)}$`,Ro="?"+Ct,Ys=`<${Ro}>`,Nt=document,Pe=()=>Nt.createComment(""),Te=s=>s===null||typeof s!="object"&&typeof s!="function",Ki=Array.isArray,Js=s=>Ki(s)||typeof s?.[Symbol.iterator]=="function",Bi=`[ 	
\f\r]`,ve=/<(?:(!--|\/[^a-zA-Z])|(\/?[a-zA-Z][^>\s]*)|(\/?$))/g,yo=/-->/g,wo=/>/g,Bt=RegExp(`>|${Bi}(?:([^\\s"'>=/]+)(${Bi}*=${Bi}*(?:[^ 	
\f\r"'\`<>=]|("|')|))|$)`,"g"),bo=/'/g,xo=/"/g,No=/^(?:script|style|textarea|title)$/i,Xs=s=>(r,...a)=>({_$litType$:s,strings:r,values:a}),$=Xs(1),Dt=Symbol.for("lit-noChange"),K=Symbol.for("lit-nothing"),ko=new WeakMap,Zt=Nt.createTreeWalker(Nt,129);function Do(s,r){if(!Ki(s)||!s.hasOwnProperty("raw"))throw Error("invalid template strings array");return vo!==void 0?vo.createHTML(r):r}const Qs=(s,r)=>{const a=s.length-1,h=[];let u,p=r===2?"<svg>":r===3?"<math>":"",f=ve;for(let v=0;v<a;v++){const _=s[v];let b,k,y=-1,S=0;for(;S<_.length&&(f.lastIndex=S,k=f.exec(_),k!==null);)S=f.lastIndex,f===ve?k[1]==="!--"?f=yo:k[1]!==void 0?f=wo:k[2]!==void 0?(No.test(k[2])&&(u=RegExp("</"+k[2],"g")),f=Bt):k[3]!==void 0&&(f=Bt):f===Bt?k[0]===">"?(f=u??ve,y=-1):k[1]===void 0?y=-2:(y=f.lastIndex-k[2].length,b=k[1],f=k[3]===void 0?Bt:k[3]==='"'?xo:bo):f===xo||f===bo?f=Bt:f===yo||f===wo?f=ve:(f=Bt,u=void 0);const R=f===Bt&&s[v+1].startsWith("/>")?" ":"";p+=f===ve?_+Ys:y>=0?(h.push(b),_.slice(0,y)+Zo+_.slice(y)+Ct+R):_+Ct+(y===-2?v:R)}return[Do(s,p+(s[a]||"<?>")+(r===2?"</svg>":r===3?"</math>":"")),h]};class Se{constructor({strings:r,_$litType$:a},h){let u;this.parts=[];let p=0,f=0;const v=r.length-1,_=this.parts,[b,k]=Qs(r,a);if(this.el=Se.createElement(b,h),Zt.currentNode=this.el.content,a===2||a===3){const y=this.el.content.firstChild;y.replaceWith(...y.childNodes)}for(;(u=Zt.nextNode())!==null&&_.length<v;){if(u.nodeType===1){if(u.hasAttributes())for(const y of u.getAttributeNames())if(y.endsWith(Zo)){const S=k[f++],R=u.getAttribute(y).split(Ct),W=/([.?@])?(.*)/.exec(S);_.push({type:1,index:p,name:W[2],strings:R,ctor:W[1]==="."?ea:W[1]==="?"?ia:W[1]==="@"?na:ei}),u.removeAttribute(y)}else y.startsWith(Ct)&&(_.push({type:6,index:p}),u.removeAttribute(y));if(No.test(u.tagName)){const y=u.textContent.split(Ct),S=y.length-1;if(S>0){u.textContent=ti?ti.emptyScript:"";for(let R=0;R<S;R++)u.append(y[R],Pe()),Zt.nextNode(),_.push({type:2,index:++p});u.append(y[S],Pe())}}}else if(u.nodeType===8)if(u.data===Ro)_.push({type:2,index:p});else{let y=-1;for(;(y=u.data.indexOf(Ct,y+1))!==-1;)_.push({type:7,index:p}),y+=Ct.length-1}p++}}static createElement(r,a){const h=Nt.createElement("template");return h.innerHTML=r,h}}function Qt(s,r,a=s,h){if(r===Dt)return r;let u=h!==void 0?a._$Co?.[h]:a._$Cl;const p=Te(r)?void 0:r._$litDirective$;return u?.constructor!==p&&(u?._$AO?.(!1),p===void 0?u=void 0:(u=new p(s),u._$AT(s,a,h)),h!==void 0?(a._$Co??(a._$Co=[]))[h]=u:a._$Cl=u),u!==void 0&&(r=Qt(s,u._$AS(s,r.values),u,h)),r}class ta{constructor(r,a){this._$AV=[],this._$AN=void 0,this._$AD=r,this._$AM=a}get parentNode(){return this._$AM.parentNode}get _$AU(){return this._$AM._$AU}u(r){const{el:{content:a},parts:h}=this._$AD,u=(r?.creationScope??Nt).importNode(a,!0);Zt.currentNode=u;let p=Zt.nextNode(),f=0,v=0,_=h[0];for(;_!==void 0;){if(f===_.index){let b;_.type===2?b=new Ce(p,p.nextSibling,this,r):_.type===1?b=new _.ctor(p,_.name,_.strings,this,r):_.type===6&&(b=new oa(p,this,r)),this._$AV.push(b),_=h[++v]}f!==_?.index&&(p=Zt.nextNode(),f++)}return Zt.currentNode=Nt,u}p(r){let a=0;for(const h of this._$AV)h!==void 0&&(h.strings!==void 0?(h._$AI(r,h,a),a+=h.strings.length-2):h._$AI(r[a])),a++}}class Ce{get _$AU(){return this._$AM?._$AU??this._$Cv}constructor(r,a,h,u){this.type=2,this._$AH=K,this._$AN=void 0,this._$AA=r,this._$AB=a,this._$AM=h,this.options=u,this._$Cv=u?.isConnected??!0}get parentNode(){let r=this._$AA.parentNode;const a=this._$AM;return a!==void 0&&r?.nodeType===11&&(r=a.parentNode),r}get startNode(){return this._$AA}get endNode(){return this._$AB}_$AI(r,a=this){r=Qt(this,r,a),Te(r)?r===K||r==null||r===""?(this._$AH!==K&&this._$AR(),this._$AH=K):r!==this._$AH&&r!==Dt&&this._(r):r._$litType$!==void 0?this.$(r):r.nodeType!==void 0?this.T(r):Js(r)?this.k(r):this._(r)}O(r){return this._$AA.parentNode.insertBefore(r,this._$AB)}T(r){this._$AH!==r&&(this._$AR(),this._$AH=this.O(r))}_(r){this._$AH!==K&&Te(this._$AH)?this._$AA.nextSibling.data=r:this.T(Nt.createTextNode(r)),this._$AH=r}$(r){const{values:a,_$litType$:h}=r,u=typeof h=="number"?this._$AC(r):(h.el===void 0&&(h.el=Se.createElement(Do(h.h,h.h[0]),this.options)),h);if(this._$AH?._$AD===u)this._$AH.p(a);else{const p=new ta(u,this),f=p.u(this.options);p.p(a),this.T(f),this._$AH=p}}_$AC(r){let a=ko.get(r.strings);return a===void 0&&ko.set(r.strings,a=new Se(r)),a}k(r){Ki(this._$AH)||(this._$AH=[],this._$AR());const a=this._$AH;let h,u=0;for(const p of r)u===a.length?a.push(h=new Ce(this.O(Pe()),this.O(Pe()),this,this.options)):h=a[u],h._$AI(p),u++;u<a.length&&(this._$AR(h&&h._$AB.nextSibling,u),a.length=u)}_$AR(r=this._$AA.nextSibling,a){for(this._$AP?.(!1,!0,a);r!==this._$AB;){const h=go(r).nextSibling;go(r).remove(),r=h}}setConnected(r){this._$AM===void 0&&(this._$Cv=r,this._$AP?.(r))}}class ei{get tagName(){return this.element.tagName}get _$AU(){return this._$AM._$AU}constructor(r,a,h,u,p){this.type=1,this._$AH=K,this._$AN=void 0,this.element=r,this.name=a,this._$AM=u,this.options=p,h.length>2||h[0]!==""||h[1]!==""?(this._$AH=Array(h.length-1).fill(new String),this.strings=h):this._$AH=K}_$AI(r,a=this,h,u){const p=this.strings;let f=!1;if(p===void 0)r=Qt(this,r,a,0),f=!Te(r)||r!==this._$AH&&r!==Dt,f&&(this._$AH=r);else{const v=r;let _,b;for(r=p[0],_=0;_<p.length-1;_++)b=Qt(this,v[h+_],a,_),b===Dt&&(b=this._$AH[_]),f||(f=!Te(b)||b!==this._$AH[_]),b===K?r=K:r!==K&&(r+=(b??"")+p[_+1]),this._$AH[_]=b}f&&!u&&this.j(r)}j(r){r===K?this.element.removeAttribute(this.name):this.element.setAttribute(this.name,r??"")}}class ea extends ei{constructor(){super(...arguments),this.type=3}j(r){this.element[this.name]=r===K?void 0:r}}let ia=class extends ei{constructor(){super(...arguments),this.type=4}j(r){this.element.toggleAttribute(this.name,!!r&&r!==K)}};class na extends ei{constructor(r,a,h,u,p){super(r,a,h,u,p),this.type=5}_$AI(r,a=this){if((r=Qt(this,r,a,0)??K)===Dt)return;const h=this._$AH,u=r===K&&h!==K||r.capture!==h.capture||r.once!==h.once||r.passive!==h.passive,p=r!==K&&(h===K||u);u&&this.element.removeEventListener(this.name,this,h),p&&this.element.addEventListener(this.name,this,r),this._$AH=r}handleEvent(r){typeof this._$AH=="function"?this._$AH.call(this.options?.host??this.element,r):this._$AH.handleEvent(r)}}class oa{constructor(r,a,h){this.element=r,this.type=6,this._$AN=void 0,this._$AM=a,this.options=h}get _$AU(){return this._$AM._$AU}_$AI(r){Qt(this,r)}}const ra=be.litHtmlPolyfillSupport;ra?.(Se,Ce),(be.litHtmlVersions??(be.litHtmlVersions=[])).push("3.3.3");const sa=(s,r,a)=>{const h=a?.renderBefore??r;let u=h._$litPart$;if(u===void 0){const p=a?.renderBefore??null;h._$litPart$=u=new Ce(r.insertBefore(Pe(),p),p,void 0,a??{})}return u._$AI(s),u};const xe=globalThis;let ke=class extends Xt{constructor(){super(...arguments),this.renderOptions={host:this},this._$Do=void 0}createRenderRoot(){var a;const r=super.createRenderRoot();return(a=this.renderOptions).renderBefore??(a.renderBefore=r.firstChild),r}update(r){const a=this.render();this.hasUpdated||(this.renderOptions.isConnected=this.isConnected),super.update(r),this._$Do=sa(a,this.renderRoot,this.renderOptions)}connectedCallback(){super.connectedCallback(),this._$Do?.setConnected(!0)}disconnectedCallback(){super.disconnectedCallback(),this._$Do?.setConnected(!1)}render(){return Dt}};ke._$litElement$=!0,ke.finalized=!0,xe.litElementHydrateSupport?.({LitElement:ke});const aa=xe.litElementPolyfillSupport;aa?.({LitElement:ke});(xe.litElementVersions??(xe.litElementVersions=[])).push("4.2.2");function la(s){return s&&s.__esModule&&Object.prototype.hasOwnProperty.call(s,"default")?s.default:s}var ye={exports:{}};var ha=ye.exports,Lo;function ua(){return Lo||(Lo=1,(function(s,r){(function(a,h){h(r)})(ha,(function(a){var h="1.9.4";function u(t){var e,i,n,o;for(i=1,n=arguments.length;i<n;i++){o=arguments[i];for(e in o)t[e]=o[e]}return t}var p=Object.create||(function(){function t(){}return function(e){return t.prototype=e,new t}})();function f(t,e){var i=Array.prototype.slice;if(t.bind)return t.bind.apply(t,i.call(arguments,1));var n=i.call(arguments,2);return function(){return t.apply(e,n.length?n.concat(i.call(arguments)):arguments)}}var v=0;function _(t){return"_leaflet_id"in t||(t._leaflet_id=++v),t._leaflet_id}function b(t,e,i){var n,o,l,c;return c=function(){n=!1,o&&(l.apply(i,o),o=!1)},l=function(){n?o=arguments:(t.apply(i,arguments),setTimeout(c,e),n=!0)},l}function k(t,e,i){var n=e[1],o=e[0],l=n-o;return t===n&&i?t:((t-o)%l+l)%l+o}function y(){return!1}function S(t,e){if(e===!1)return t;var i=Math.pow(10,e===void 0?6:e);return Math.round(t*i)/i}function R(t){return t.trim?t.trim():t.replace(/^\s+|\s+$/g,"")}function W(t){return R(t).split(/\s+/)}function O(t,e){Object.prototype.hasOwnProperty.call(t,"options")||(t.options=t.options?p(t.options):{});for(var i in e)t.options[i]=e[i];return t.options}function pt(t,e,i){var n=[];for(var o in t)n.push(encodeURIComponent(i?o.toUpperCase():o)+"="+encodeURIComponent(t[o]));return(!e||e.indexOf("?")===-1?"?":"&")+n.join("&")}var Ht=/\{ *([\w_ -]+) *\}/g;function Ae(t,e){return t.replace(Ht,function(i,n){var o=e[n];if(o===void 0)throw new Error("No value provided for variable "+i);return typeof o=="function"&&(o=o(e)),o})}var rt=Array.isArray||function(t){return Object.prototype.toString.call(t)==="[object Array]"};function te(t,e){for(var i=0;i<t.length;i++)if(t[i]===e)return i;return-1}var Pt="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=";function ee(t){return window["webkit"+t]||window["moz"+t]||window["ms"+t]}var ze=0;function Ee(t){var e=+new Date,i=Math.max(0,16-(e-ze));return ze=e+i,window.setTimeout(t,i)}var ie=window.requestAnimationFrame||ee("RequestAnimationFrame")||Ee,vt=window.cancelAnimationFrame||ee("CancelAnimationFrame")||ee("CancelRequestAnimationFrame")||function(t){window.clearTimeout(t)};function tt(t,e,i){if(i&&ie===Ee)t.call(e);else return ie.call(window,f(t,e))}function at(t){t&&vt.call(window,t)}var ar={__proto__:null,extend:u,create:p,bind:f,get lastId(){return v},stamp:_,throttle:b,wrapNum:k,falseFn:y,formatNum:S,trim:R,splitWords:W,setOptions:O,getParamString:pt,template:Ae,isArray:rt,indexOf:te,emptyImageUrl:Pt,requestFn:ie,cancelFn:vt,requestAnimFrame:tt,cancelAnimFrame:at};function yt(){}yt.extend=function(t){var e=function(){O(this),this.initialize&&this.initialize.apply(this,arguments),this.callInitHooks()},i=e.__super__=this.prototype,n=p(i);n.constructor=e,e.prototype=n;for(var o in this)Object.prototype.hasOwnProperty.call(this,o)&&o!=="prototype"&&o!=="__super__"&&(e[o]=this[o]);return t.statics&&u(e,t.statics),t.includes&&(lr(t.includes),u.apply(null,[n].concat(t.includes))),u(n,t),delete n.statics,delete n.includes,n.options&&(n.options=i.options?p(i.options):{},u(n.options,t.options)),n._initHooks=[],n.callInitHooks=function(){if(!this._initHooksCalled){i.callInitHooks&&i.callInitHooks.call(this),this._initHooksCalled=!0;for(var l=0,c=n._initHooks.length;l<c;l++)n._initHooks[l].call(this)}},e},yt.include=function(t){var e=this.prototype.options;return u(this.prototype,t),t.options&&(this.prototype.options=e,this.mergeOptions(t.options)),this},yt.mergeOptions=function(t){return u(this.prototype.options,t),this},yt.addInitHook=function(t){var e=Array.prototype.slice.call(arguments,1),i=typeof t=="function"?t:function(){this[t].apply(this,e)};return this.prototype._initHooks=this.prototype._initHooks||[],this.prototype._initHooks.push(i),this};function lr(t){if(!(typeof L>"u"||!L||!L.Mixin)){t=rt(t)?t:[t];for(var e=0;e<t.length;e++)t[e]===L.Mixin.Events&&console.warn("Deprecated include of L.Mixin.Events: this property will be removed in future releases, please inherit from L.Evented instead.",new Error().stack)}}var st={on:function(t,e,i){if(typeof t=="object")for(var n in t)this._on(n,t[n],e);else{t=W(t);for(var o=0,l=t.length;o<l;o++)this._on(t[o],e,i)}return this},off:function(t,e,i){if(!arguments.length)delete this._events;else if(typeof t=="object")for(var n in t)this._off(n,t[n],e);else{t=W(t);for(var o=arguments.length===1,l=0,c=t.length;l<c;l++)o?this._off(t[l]):this._off(t[l],e,i)}return this},_on:function(t,e,i,n){if(typeof e!="function"){console.warn("wrong listener type: "+typeof e);return}if(this._listens(t,e,i)===!1){i===this&&(i=void 0);var o={fn:e,ctx:i};n&&(o.once=!0),this._events=this._events||{},this._events[t]=this._events[t]||[],this._events[t].push(o)}},_off:function(t,e,i){var n,o,l;if(this._events&&(n=this._events[t],!!n)){if(arguments.length===1){if(this._firingCount)for(o=0,l=n.length;o<l;o++)n[o].fn=y;delete this._events[t];return}if(typeof e!="function"){console.warn("wrong listener type: "+typeof e);return}var c=this._listens(t,e,i);if(c!==!1){var d=n[c];this._firingCount&&(d.fn=y,this._events[t]=n=n.slice()),n.splice(c,1)}}},fire:function(t,e,i){if(!this.listens(t,i))return this;var n=u({},e,{type:t,target:this,sourceTarget:e&&e.sourceTarget||this});if(this._events){var o=this._events[t];if(o){this._firingCount=this._firingCount+1||1;for(var l=0,c=o.length;l<c;l++){var d=o[l],m=d.fn;d.once&&this.off(t,m,d.ctx),m.call(d.ctx||this,n)}this._firingCount--}}return i&&this._propagateEvent(n),this},listens:function(t,e,i,n){typeof t!="string"&&console.warn('"string" type argument expected');var o=e;typeof e!="function"&&(n=!!e,o=void 0,i=void 0);var l=this._events&&this._events[t];if(l&&l.length&&this._listens(t,o,i)!==!1)return!0;if(n){for(var c in this._eventParents)if(this._eventParents[c].listens(t,e,i,n))return!0}return!1},_listens:function(t,e,i){if(!this._events)return!1;var n=this._events[t]||[];if(!e)return!!n.length;i===this&&(i=void 0);for(var o=0,l=n.length;o<l;o++)if(n[o].fn===e&&n[o].ctx===i)return o;return!1},once:function(t,e,i){if(typeof t=="object")for(var n in t)this._on(n,t[n],e,!0);else{t=W(t);for(var o=0,l=t.length;o<l;o++)this._on(t[o],e,i,!0)}return this},addEventParent:function(t){return this._eventParents=this._eventParents||{},this._eventParents[_(t)]=t,this},removeEventParent:function(t){return this._eventParents&&delete this._eventParents[_(t)],this},_propagateEvent:function(t){for(var e in this._eventParents)this._eventParents[e].fire(t.type,u({layer:t.target,propagatedFrom:t.target},t),!0)}};st.addEventListener=st.on,st.removeEventListener=st.clearAllEventListeners=st.off,st.addOneTimeEventListener=st.once,st.fireEvent=st.fire,st.hasEventListeners=st.listens;var ne=yt.extend(st);function M(t,e,i){this.x=i?Math.round(t):t,this.y=i?Math.round(e):e}var Xi=Math.trunc||function(t){return t>0?Math.floor(t):Math.ceil(t)};M.prototype={clone:function(){return new M(this.x,this.y)},add:function(t){return this.clone()._add(T(t))},_add:function(t){return this.x+=t.x,this.y+=t.y,this},subtract:function(t){return this.clone()._subtract(T(t))},_subtract:function(t){return this.x-=t.x,this.y-=t.y,this},divideBy:function(t){return this.clone()._divideBy(t)},_divideBy:function(t){return this.x/=t,this.y/=t,this},multiplyBy:function(t){return this.clone()._multiplyBy(t)},_multiplyBy:function(t){return this.x*=t,this.y*=t,this},scaleBy:function(t){return new M(this.x*t.x,this.y*t.y)},unscaleBy:function(t){return new M(this.x/t.x,this.y/t.y)},round:function(){return this.clone()._round()},_round:function(){return this.x=Math.round(this.x),this.y=Math.round(this.y),this},floor:function(){return this.clone()._floor()},_floor:function(){return this.x=Math.floor(this.x),this.y=Math.floor(this.y),this},ceil:function(){return this.clone()._ceil()},_ceil:function(){return this.x=Math.ceil(this.x),this.y=Math.ceil(this.y),this},trunc:function(){return this.clone()._trunc()},_trunc:function(){return this.x=Xi(this.x),this.y=Xi(this.y),this},distanceTo:function(t){t=T(t);var e=t.x-this.x,i=t.y-this.y;return Math.sqrt(e*e+i*i)},equals:function(t){return t=T(t),t.x===this.x&&t.y===this.y},contains:function(t){return t=T(t),Math.abs(t.x)<=Math.abs(this.x)&&Math.abs(t.y)<=Math.abs(this.y)},toString:function(){return"Point("+S(this.x)+", "+S(this.y)+")"}};function T(t,e,i){return t instanceof M?t:rt(t)?new M(t[0],t[1]):t==null?t:typeof t=="object"&&"x"in t&&"y"in t?new M(t.x,t.y):new M(t,e,i)}function F(t,e){if(t)for(var i=e?[t,e]:t,n=0,o=i.length;n<o;n++)this.extend(i[n])}F.prototype={extend:function(t){var e,i;if(!t)return this;if(t instanceof M||typeof t[0]=="number"||"x"in t)e=i=T(t);else if(t=it(t),e=t.min,i=t.max,!e||!i)return this;return!this.min&&!this.max?(this.min=e.clone(),this.max=i.clone()):(this.min.x=Math.min(e.x,this.min.x),this.max.x=Math.max(i.x,this.max.x),this.min.y=Math.min(e.y,this.min.y),this.max.y=Math.max(i.y,this.max.y)),this},getCenter:function(t){return T((this.min.x+this.max.x)/2,(this.min.y+this.max.y)/2,t)},getBottomLeft:function(){return T(this.min.x,this.max.y)},getTopRight:function(){return T(this.max.x,this.min.y)},getTopLeft:function(){return this.min},getBottomRight:function(){return this.max},getSize:function(){return this.max.subtract(this.min)},contains:function(t){var e,i;return typeof t[0]=="number"||t instanceof M?t=T(t):t=it(t),t instanceof F?(e=t.min,i=t.max):e=i=t,e.x>=this.min.x&&i.x<=this.max.x&&e.y>=this.min.y&&i.y<=this.max.y},intersects:function(t){t=it(t);var e=this.min,i=this.max,n=t.min,o=t.max,l=o.x>=e.x&&n.x<=i.x,c=o.y>=e.y&&n.y<=i.y;return l&&c},overlaps:function(t){t=it(t);var e=this.min,i=this.max,n=t.min,o=t.max,l=o.x>e.x&&n.x<i.x,c=o.y>e.y&&n.y<i.y;return l&&c},isValid:function(){return!!(this.min&&this.max)},pad:function(t){var e=this.min,i=this.max,n=Math.abs(e.x-i.x)*t,o=Math.abs(e.y-i.y)*t;return it(T(e.x-n,e.y-o),T(i.x+n,i.y+o))},equals:function(t){return t?(t=it(t),this.min.equals(t.getTopLeft())&&this.max.equals(t.getBottomRight())):!1}};function it(t,e){return!t||t instanceof F?t:new F(t,e)}function nt(t,e){if(t)for(var i=e?[t,e]:t,n=0,o=i.length;n<o;n++)this.extend(i[n])}nt.prototype={extend:function(t){var e=this._southWest,i=this._northEast,n,o;if(t instanceof N)n=t,o=t;else if(t instanceof nt){if(n=t._southWest,o=t._northEast,!n||!o)return this}else return t?this.extend(I(t)||j(t)):this;return!e&&!i?(this._southWest=new N(n.lat,n.lng),this._northEast=new N(o.lat,o.lng)):(e.lat=Math.min(n.lat,e.lat),e.lng=Math.min(n.lng,e.lng),i.lat=Math.max(o.lat,i.lat),i.lng=Math.max(o.lng,i.lng)),this},pad:function(t){var e=this._southWest,i=this._northEast,n=Math.abs(e.lat-i.lat)*t,o=Math.abs(e.lng-i.lng)*t;return new nt(new N(e.lat-n,e.lng-o),new N(i.lat+n,i.lng+o))},getCenter:function(){return new N((this._southWest.lat+this._northEast.lat)/2,(this._southWest.lng+this._northEast.lng)/2)},getSouthWest:function(){return this._southWest},getNorthEast:function(){return this._northEast},getNorthWest:function(){return new N(this.getNorth(),this.getWest())},getSouthEast:function(){return new N(this.getSouth(),this.getEast())},getWest:function(){return this._southWest.lng},getSouth:function(){return this._southWest.lat},getEast:function(){return this._northEast.lng},getNorth:function(){return this._northEast.lat},contains:function(t){typeof t[0]=="number"||t instanceof N||"lat"in t?t=I(t):t=j(t);var e=this._southWest,i=this._northEast,n,o;return t instanceof nt?(n=t.getSouthWest(),o=t.getNorthEast()):n=o=t,n.lat>=e.lat&&o.lat<=i.lat&&n.lng>=e.lng&&o.lng<=i.lng},intersects:function(t){t=j(t);var e=this._southWest,i=this._northEast,n=t.getSouthWest(),o=t.getNorthEast(),l=o.lat>=e.lat&&n.lat<=i.lat,c=o.lng>=e.lng&&n.lng<=i.lng;return l&&c},overlaps:function(t){t=j(t);var e=this._southWest,i=this._northEast,n=t.getSouthWest(),o=t.getNorthEast(),l=o.lat>e.lat&&n.lat<i.lat,c=o.lng>e.lng&&n.lng<i.lng;return l&&c},toBBoxString:function(){return[this.getWest(),this.getSouth(),this.getEast(),this.getNorth()].join(",")},equals:function(t,e){return t?(t=j(t),this._southWest.equals(t.getSouthWest(),e)&&this._northEast.equals(t.getNorthEast(),e)):!1},isValid:function(){return!!(this._southWest&&this._northEast)}};function j(t,e){return t instanceof nt?t:new nt(t,e)}function N(t,e,i){if(isNaN(t)||isNaN(e))throw new Error("Invalid LatLng object: ("+t+", "+e+")");this.lat=+t,this.lng=+e,i!==void 0&&(this.alt=+i)}N.prototype={equals:function(t,e){if(!t)return!1;t=I(t);var i=Math.max(Math.abs(this.lat-t.lat),Math.abs(this.lng-t.lng));return i<=(e===void 0?1e-9:e)},toString:function(t){return"LatLng("+S(this.lat,t)+", "+S(this.lng,t)+")"},distanceTo:function(t){return Tt.distance(this,I(t))},wrap:function(){return Tt.wrapLatLng(this)},toBounds:function(t){var e=180*t/40075017,i=e/Math.cos(Math.PI/180*this.lat);return j([this.lat-e,this.lng-i],[this.lat+e,this.lng+i])},clone:function(){return new N(this.lat,this.lng,this.alt)}};function I(t,e,i){return t instanceof N?t:rt(t)&&typeof t[0]!="object"?t.length===3?new N(t[0],t[1],t[2]):t.length===2?new N(t[0],t[1]):null:t==null?t:typeof t=="object"&&"lat"in t?new N(t.lat,"lng"in t?t.lng:t.lon,t.alt):e===void 0?null:new N(t,e,i)}var wt={latLngToPoint:function(t,e){var i=this.projection.project(t),n=this.scale(e);return this.transformation._transform(i,n)},pointToLatLng:function(t,e){var i=this.scale(e),n=this.transformation.untransform(t,i);return this.projection.unproject(n)},project:function(t){return this.projection.project(t)},unproject:function(t){return this.projection.unproject(t)},scale:function(t){return 256*Math.pow(2,t)},zoom:function(t){return Math.log(t/256)/Math.LN2},getProjectedBounds:function(t){if(this.infinite)return null;var e=this.projection.bounds,i=this.scale(t),n=this.transformation.transform(e.min,i),o=this.transformation.transform(e.max,i);return new F(n,o)},infinite:!1,wrapLatLng:function(t){var e=this.wrapLng?k(t.lng,this.wrapLng,!0):t.lng,i=this.wrapLat?k(t.lat,this.wrapLat,!0):t.lat,n=t.alt;return new N(i,e,n)},wrapLatLngBounds:function(t){var e=t.getCenter(),i=this.wrapLatLng(e),n=e.lat-i.lat,o=e.lng-i.lng;if(n===0&&o===0)return t;var l=t.getSouthWest(),c=t.getNorthEast(),d=new N(l.lat-n,l.lng-o),m=new N(c.lat-n,c.lng-o);return new nt(d,m)}},Tt=u({},wt,{wrapLng:[-180,180],R:6371e3,distance:function(t,e){var i=Math.PI/180,n=t.lat*i,o=e.lat*i,l=Math.sin((e.lat-t.lat)*i/2),c=Math.sin((e.lng-t.lng)*i/2),d=l*l+Math.cos(n)*Math.cos(o)*c*c,m=2*Math.atan2(Math.sqrt(d),Math.sqrt(1-d));return this.R*m}}),Qi=6378137,ii={R:Qi,MAX_LATITUDE:85.0511287798,project:function(t){var e=Math.PI/180,i=this.MAX_LATITUDE,n=Math.max(Math.min(i,t.lat),-i),o=Math.sin(n*e);return new M(this.R*t.lng*e,this.R*Math.log((1+o)/(1-o))/2)},unproject:function(t){var e=180/Math.PI;return new N((2*Math.atan(Math.exp(t.y/this.R))-Math.PI/2)*e,t.x*e/this.R)},bounds:(function(){var t=Qi*Math.PI;return new F([-t,-t],[t,t])})()};function ni(t,e,i,n){if(rt(t)){this._a=t[0],this._b=t[1],this._c=t[2],this._d=t[3];return}this._a=t,this._b=e,this._c=i,this._d=n}ni.prototype={transform:function(t,e){return this._transform(t.clone(),e)},_transform:function(t,e){return e=e||1,t.x=e*(this._a*t.x+this._b),t.y=e*(this._c*t.y+this._d),t},untransform:function(t,e){return e=e||1,new M((t.x/e-this._b)/this._a,(t.y/e-this._d)/this._c)}};function oe(t,e,i,n){return new ni(t,e,i,n)}var oi=u({},Tt,{code:"EPSG:3857",projection:ii,transformation:(function(){var t=.5/(Math.PI*ii.R);return oe(t,.5,-t,.5)})()}),hr=u({},oi,{code:"EPSG:900913"});function tn(t){return document.createElementNS("http://www.w3.org/2000/svg",t)}function en(t,e){var i="",n,o,l,c,d,m;for(n=0,l=t.length;n<l;n++){for(d=t[n],o=0,c=d.length;o<c;o++)m=d[o],i+=(o?"L":"M")+m.x+" "+m.y;i+=e?x.svg?"z":"x":""}return i||"M0 0"}var ri=document.documentElement.style,Oe="ActiveXObject"in window,ur=Oe&&!document.addEventListener,nn="msLaunchUri"in navigator&&!("documentMode"in document),si=ft("webkit"),on=ft("android"),rn=ft("android 2")||ft("android 3"),cr=parseInt(/WebKit\/([0-9]+)|$/.exec(navigator.userAgent)[1],10),dr=on&&ft("Google")&&cr<537&&!("AudioNode"in window),ai=!!window.opera,sn=!nn&&ft("chrome"),an=ft("gecko")&&!si&&!ai&&!Oe,pr=!sn&&ft("safari"),ln=ft("phantom"),hn="OTransition"in ri,fr=navigator.platform.indexOf("Win")===0,un=Oe&&"transition"in ri,li="WebKitCSSMatrix"in window&&"m11"in new window.WebKitCSSMatrix&&!rn,cn="MozPerspective"in ri,mr=!window.L_DISABLE_3D&&(un||li||cn)&&!hn&&!ln,re=typeof orientation<"u"||ft("mobile"),_r=re&&si,gr=re&&li,dn=!window.PointerEvent&&window.MSPointerEvent,pn=!!(window.PointerEvent||dn),fn="ontouchstart"in window||!!window.TouchEvent,vr=!window.L_NO_TOUCH&&(fn||pn),yr=re&&ai,wr=re&&an,br=(window.devicePixelRatio||window.screen.deviceXDPI/window.screen.logicalXDPI)>1,xr=(function(){var t=!1;try{var e=Object.defineProperty({},"passive",{get:function(){t=!0}});window.addEventListener("testPassiveEventSupport",y,e),window.removeEventListener("testPassiveEventSupport",y,e)}catch{}return t})(),kr=(function(){return!!document.createElement("canvas").getContext})(),hi=!!(document.createElementNS&&tn("svg").createSVGRect),Lr=!!hi&&(function(){var t=document.createElement("div");return t.innerHTML="<svg/>",(t.firstChild&&t.firstChild.namespaceURI)==="http://www.w3.org/2000/svg"})(),Pr=!hi&&(function(){try{var t=document.createElement("div");t.innerHTML='<v:shape adj="1"/>';var e=t.firstChild;return e.style.behavior="url(#default#VML)",e&&typeof e.adj=="object"}catch{return!1}})(),Tr=navigator.platform.indexOf("Mac")===0,Sr=navigator.platform.indexOf("Linux")===0;function ft(t){return navigator.userAgent.toLowerCase().indexOf(t)>=0}var x={ie:Oe,ielt9:ur,edge:nn,webkit:si,android:on,android23:rn,androidStock:dr,opera:ai,chrome:sn,gecko:an,safari:pr,phantom:ln,opera12:hn,win:fr,ie3d:un,webkit3d:li,gecko3d:cn,any3d:mr,mobile:re,mobileWebkit:_r,mobileWebkit3d:gr,msPointer:dn,pointer:pn,touch:vr,touchNative:fn,mobileOpera:yr,mobileGecko:wr,retina:br,passiveEvents:xr,canvas:kr,svg:hi,vml:Pr,inlineSvg:Lr,mac:Tr,linux:Sr},mn=x.msPointer?"MSPointerDown":"pointerdown",_n=x.msPointer?"MSPointerMove":"pointermove",gn=x.msPointer?"MSPointerUp":"pointerup",vn=x.msPointer?"MSPointerCancel":"pointercancel",ui={touchstart:mn,touchmove:_n,touchend:gn,touchcancel:vn},yn={touchstart:Or,touchmove:$e,touchend:$e,touchcancel:$e},Ut={},wn=!1;function Mr(t,e,i){return e==="touchstart"&&Er(),yn[e]?(i=yn[e].bind(this,i),t.addEventListener(ui[e],i,!1),i):(console.warn("wrong event specified:",e),y)}function Cr(t,e,i){if(!ui[e]){console.warn("wrong event specified:",e);return}t.removeEventListener(ui[e],i,!1)}function Ar(t){Ut[t.pointerId]=t}function zr(t){Ut[t.pointerId]&&(Ut[t.pointerId]=t)}function bn(t){delete Ut[t.pointerId]}function Er(){wn||(document.addEventListener(mn,Ar,!0),document.addEventListener(_n,zr,!0),document.addEventListener(gn,bn,!0),document.addEventListener(vn,bn,!0),wn=!0)}function $e(t,e){if(e.pointerType!==(e.MSPOINTER_TYPE_MOUSE||"mouse")){e.touches=[];for(var i in Ut)e.touches.push(Ut[i]);e.changedTouches=[e],t(e)}}function Or(t,e){e.MSPOINTER_TYPE_TOUCH&&e.pointerType===e.MSPOINTER_TYPE_TOUCH&&X(e),$e(t,e)}function $r(t){var e={},i,n;for(n in t)i=t[n],e[n]=i&&i.bind?i.bind(t):i;return t=e,e.type="dblclick",e.detail=2,e.isTrusted=!1,e._simulated=!0,e}var Ir=200;function Br(t,e){t.addEventListener("dblclick",e);var i=0,n;function o(l){if(l.detail!==1){n=l.detail;return}if(!(l.pointerType==="mouse"||l.sourceCapabilities&&!l.sourceCapabilities.firesTouchEvents)){var c=Tn(l);if(!(c.some(function(m){return m instanceof HTMLLabelElement&&m.attributes.for})&&!c.some(function(m){return m instanceof HTMLInputElement||m instanceof HTMLSelectElement}))){var d=Date.now();d-i<=Ir?(n++,n===2&&e($r(l))):n=1,i=d}}}return t.addEventListener("click",o),{dblclick:e,simDblclick:o}}function Zr(t,e){t.removeEventListener("dblclick",e.dblclick),t.removeEventListener("click",e.simDblclick)}var ci=Ze(["transform","webkitTransform","OTransform","MozTransform","msTransform"]),se=Ze(["webkitTransition","transition","OTransition","MozTransition","msTransition"]),xn=se==="webkitTransition"||se==="OTransition"?se+"End":"transitionend";function kn(t){return typeof t=="string"?document.getElementById(t):t}function ae(t,e){var i=t.style[e]||t.currentStyle&&t.currentStyle[e];if((!i||i==="auto")&&document.defaultView){var n=document.defaultView.getComputedStyle(t,null);i=n?n[e]:null}return i==="auto"?null:i}function Z(t,e,i){var n=document.createElement(t);return n.className=e||"",i&&i.appendChild(n),n}function H(t){var e=t.parentNode;e&&e.removeChild(t)}function Ie(t){for(;t.firstChild;)t.removeChild(t.firstChild)}function Wt(t){var e=t.parentNode;e&&e.lastChild!==t&&e.appendChild(t)}function qt(t){var e=t.parentNode;e&&e.firstChild!==t&&e.insertBefore(t,e.firstChild)}function di(t,e){if(t.classList!==void 0)return t.classList.contains(e);var i=Be(t);return i.length>0&&new RegExp("(^|\\s)"+e+"(\\s|$)").test(i)}function A(t,e){if(t.classList!==void 0)for(var i=W(e),n=0,o=i.length;n<o;n++)t.classList.add(i[n]);else if(!di(t,e)){var l=Be(t);pi(t,(l?l+" ":"")+e)}}function q(t,e){t.classList!==void 0?t.classList.remove(e):pi(t,R((" "+Be(t)+" ").replace(" "+e+" "," ")))}function pi(t,e){t.className.baseVal===void 0?t.className=e:t.className.baseVal=e}function Be(t){return t.correspondingElement&&(t=t.correspondingElement),t.className.baseVal===void 0?t.className:t.className.baseVal}function lt(t,e){"opacity"in t.style?t.style.opacity=e:"filter"in t.style&&Rr(t,e)}function Rr(t,e){var i=!1,n="DXImageTransform.Microsoft.Alpha";try{i=t.filters.item(n)}catch{if(e===1)return}e=Math.round(e*100),i?(i.Enabled=e!==100,i.Opacity=e):t.style.filter+=" progid:"+n+"(opacity="+e+")"}function Ze(t){for(var e=document.documentElement.style,i=0;i<t.length;i++)if(t[i]in e)return t[i];return!1}function zt(t,e,i){var n=e||new M(0,0);t.style[ci]=(x.ie3d?"translate("+n.x+"px,"+n.y+"px)":"translate3d("+n.x+"px,"+n.y+"px,0)")+(i?" scale("+i+")":"")}function G(t,e){t._leaflet_pos=e,x.any3d?zt(t,e):(t.style.left=e.x+"px",t.style.top=e.y+"px")}function Et(t){return t._leaflet_pos||new M(0,0)}var le,he,fi;if("onselectstart"in document)le=function(){C(window,"selectstart",X)},he=function(){D(window,"selectstart",X)};else{var ue=Ze(["userSelect","WebkitUserSelect","OUserSelect","MozUserSelect","msUserSelect"]);le=function(){if(ue){var t=document.documentElement.style;fi=t[ue],t[ue]="none"}},he=function(){ue&&(document.documentElement.style[ue]=fi,fi=void 0)}}function mi(){C(window,"dragstart",X)}function _i(){D(window,"dragstart",X)}var Re,gi;function vi(t){for(;t.tabIndex===-1;)t=t.parentNode;t.style&&(Ne(),Re=t,gi=t.style.outlineStyle,t.style.outlineStyle="none",C(window,"keydown",Ne))}function Ne(){Re&&(Re.style.outlineStyle=gi,Re=void 0,gi=void 0,D(window,"keydown",Ne))}function Ln(t){do t=t.parentNode;while((!t.offsetWidth||!t.offsetHeight)&&t!==document.body);return t}function yi(t){var e=t.getBoundingClientRect();return{x:e.width/t.offsetWidth||1,y:e.height/t.offsetHeight||1,boundingClientRect:e}}var Nr={__proto__:null,TRANSFORM:ci,TRANSITION:se,TRANSITION_END:xn,get:kn,getStyle:ae,create:Z,remove:H,empty:Ie,toFront:Wt,toBack:qt,hasClass:di,addClass:A,removeClass:q,setClass:pi,getClass:Be,setOpacity:lt,testProp:Ze,setTransform:zt,setPosition:G,getPosition:Et,get disableTextSelection(){return le},get enableTextSelection(){return he},disableImageDrag:mi,enableImageDrag:_i,preventOutline:vi,restoreOutline:Ne,getSizedParentNode:Ln,getScale:yi};function C(t,e,i,n){if(e&&typeof e=="object")for(var o in e)bi(t,o,e[o],i);else{e=W(e);for(var l=0,c=e.length;l<c;l++)bi(t,e[l],i,n)}return this}var mt="_leaflet_events";function D(t,e,i,n){if(arguments.length===1)Pn(t),delete t[mt];else if(e&&typeof e=="object")for(var o in e)xi(t,o,e[o],i);else if(e=W(e),arguments.length===2)Pn(t,function(d){return te(e,d)!==-1});else for(var l=0,c=e.length;l<c;l++)xi(t,e[l],i,n);return this}function Pn(t,e){for(var i in t[mt]){var n=i.split(/\d/)[0];(!e||e(n))&&xi(t,n,null,null,i)}}var wi={mouseenter:"mouseover",mouseleave:"mouseout",wheel:!("onwheel"in window)&&"mousewheel"};function bi(t,e,i,n){var o=e+_(i)+(n?"_"+_(n):"");if(t[mt]&&t[mt][o])return this;var l=function(d){return i.call(n||t,d||window.event)},c=l;!x.touchNative&&x.pointer&&e.indexOf("touch")===0?l=Mr(t,e,l):x.touch&&e==="dblclick"?l=Br(t,l):"addEventListener"in t?e==="touchstart"||e==="touchmove"||e==="wheel"||e==="mousewheel"?t.addEventListener(wi[e]||e,l,x.passiveEvents?{passive:!1}:!1):e==="mouseenter"||e==="mouseleave"?(l=function(d){d=d||window.event,Li(t,d)&&c(d)},t.addEventListener(wi[e],l,!1)):t.addEventListener(e,c,!1):t.attachEvent("on"+e,l),t[mt]=t[mt]||{},t[mt][o]=l}function xi(t,e,i,n,o){o=o||e+_(i)+(n?"_"+_(n):"");var l=t[mt]&&t[mt][o];if(!l)return this;!x.touchNative&&x.pointer&&e.indexOf("touch")===0?Cr(t,e,l):x.touch&&e==="dblclick"?Zr(t,l):"removeEventListener"in t?t.removeEventListener(wi[e]||e,l,!1):t.detachEvent("on"+e,l),t[mt][o]=null}function Ot(t){return t.stopPropagation?t.stopPropagation():t.originalEvent?t.originalEvent._stopped=!0:t.cancelBubble=!0,this}function ki(t){return bi(t,"wheel",Ot),this}function ce(t){return C(t,"mousedown touchstart dblclick contextmenu",Ot),t._leaflet_disable_click=!0,this}function X(t){return t.preventDefault?t.preventDefault():t.returnValue=!1,this}function $t(t){return X(t),Ot(t),this}function Tn(t){if(t.composedPath)return t.composedPath();for(var e=[],i=t.target;i;)e.push(i),i=i.parentNode;return e}function Sn(t,e){if(!e)return new M(t.clientX,t.clientY);var i=yi(e),n=i.boundingClientRect;return new M((t.clientX-n.left)/i.x-e.clientLeft,(t.clientY-n.top)/i.y-e.clientTop)}var Dr=x.linux&&x.chrome?window.devicePixelRatio:x.mac?window.devicePixelRatio*3:window.devicePixelRatio>0?2*window.devicePixelRatio:1;function Mn(t){return x.edge?t.wheelDeltaY/2:t.deltaY&&t.deltaMode===0?-t.deltaY/Dr:t.deltaY&&t.deltaMode===1?-t.deltaY*20:t.deltaY&&t.deltaMode===2?-t.deltaY*60:t.deltaX||t.deltaZ?0:t.wheelDelta?(t.wheelDeltaY||t.wheelDelta)/2:t.detail&&Math.abs(t.detail)<32765?-t.detail*20:t.detail?t.detail/-32765*60:0}function Li(t,e){var i=e.relatedTarget;if(!i)return!0;try{for(;i&&i!==t;)i=i.parentNode}catch{return!1}return i!==t}var Fr={__proto__:null,on:C,off:D,stopPropagation:Ot,disableScrollPropagation:ki,disableClickPropagation:ce,preventDefault:X,stop:$t,getPropagationPath:Tn,getMousePosition:Sn,getWheelDelta:Mn,isExternalTarget:Li,addListener:C,removeListener:D},Cn=ne.extend({run:function(t,e,i,n){this.stop(),this._el=t,this._inProgress=!0,this._duration=i||.25,this._easeOutPower=1/Math.max(n||.5,.2),this._startPos=Et(t),this._offset=e.subtract(this._startPos),this._startTime=+new Date,this.fire("start"),this._animate()},stop:function(){this._inProgress&&(this._step(!0),this._complete())},_animate:function(){this._animId=tt(this._animate,this),this._step()},_step:function(t){var e=+new Date-this._startTime,i=this._duration*1e3;e<i?this._runFrame(this._easeOut(e/i),t):(this._runFrame(1),this._complete())},_runFrame:function(t,e){var i=this._startPos.add(this._offset.multiplyBy(t));e&&i._round(),G(this._el,i),this.fire("step")},_complete:function(){at(this._animId),this._inProgress=!1,this.fire("end")},_easeOut:function(t){return 1-Math.pow(1-t,this._easeOutPower)}}),B=ne.extend({options:{crs:oi,center:void 0,zoom:void 0,minZoom:void 0,maxZoom:void 0,layers:[],maxBounds:void 0,renderer:void 0,zoomAnimation:!0,zoomAnimationThreshold:4,fadeAnimation:!0,markerZoomAnimation:!0,transform3DLimit:8388608,zoomSnap:1,zoomDelta:1,trackResize:!0},initialize:function(t,e){e=O(this,e),this._handlers=[],this._layers={},this._zoomBoundLayers={},this._sizeChanged=!0,this._initContainer(t),this._initLayout(),this._onResize=f(this._onResize,this),this._initEvents(),e.maxBounds&&this.setMaxBounds(e.maxBounds),e.zoom!==void 0&&(this._zoom=this._limitZoom(e.zoom)),e.center&&e.zoom!==void 0&&this.setView(I(e.center),e.zoom,{reset:!0}),this.callInitHooks(),this._zoomAnimated=se&&x.any3d&&!x.mobileOpera&&this.options.zoomAnimation,this._zoomAnimated&&(this._createAnimProxy(),C(this._proxy,xn,this._catchTransitionEnd,this)),this._addLayers(this.options.layers)},setView:function(t,e,i){if(e=e===void 0?this._zoom:this._limitZoom(e),t=this._limitCenter(I(t),e,this.options.maxBounds),i=i||{},this._stop(),this._loaded&&!i.reset&&i!==!0){i.animate!==void 0&&(i.zoom=u({animate:i.animate},i.zoom),i.pan=u({animate:i.animate,duration:i.duration},i.pan));var n=this._zoom!==e?this._tryAnimatedZoom&&this._tryAnimatedZoom(t,e,i.zoom):this._tryAnimatedPan(t,i.pan);if(n)return clearTimeout(this._sizeTimer),this}return this._resetView(t,e,i.pan&&i.pan.noMoveStart),this},setZoom:function(t,e){return this._loaded?this.setView(this.getCenter(),t,{zoom:e}):(this._zoom=t,this)},zoomIn:function(t,e){return t=t||(x.any3d?this.options.zoomDelta:1),this.setZoom(this._zoom+t,e)},zoomOut:function(t,e){return t=t||(x.any3d?this.options.zoomDelta:1),this.setZoom(this._zoom-t,e)},setZoomAround:function(t,e,i){var n=this.getZoomScale(e),o=this.getSize().divideBy(2),l=t instanceof M?t:this.latLngToContainerPoint(t),c=l.subtract(o).multiplyBy(1-1/n),d=this.containerPointToLatLng(o.add(c));return this.setView(d,e,{zoom:i})},_getBoundsCenterZoom:function(t,e){e=e||{},t=t.getBounds?t.getBounds():j(t);var i=T(e.paddingTopLeft||e.padding||[0,0]),n=T(e.paddingBottomRight||e.padding||[0,0]),o=this.getBoundsZoom(t,!1,i.add(n));if(o=typeof e.maxZoom=="number"?Math.min(e.maxZoom,o):o,o===1/0)return{center:t.getCenter(),zoom:o};var l=n.subtract(i).divideBy(2),c=this.project(t.getSouthWest(),o),d=this.project(t.getNorthEast(),o),m=this.unproject(c.add(d).divideBy(2).add(l),o);return{center:m,zoom:o}},fitBounds:function(t,e){if(t=j(t),!t.isValid())throw new Error("Bounds are not valid.");var i=this._getBoundsCenterZoom(t,e);return this.setView(i.center,i.zoom,e)},fitWorld:function(t){return this.fitBounds([[-90,-180],[90,180]],t)},panTo:function(t,e){return this.setView(t,this._zoom,{pan:e})},panBy:function(t,e){if(t=T(t).round(),e=e||{},!t.x&&!t.y)return this.fire("moveend");if(e.animate!==!0&&!this.getSize().contains(t))return this._resetView(this.unproject(this.project(this.getCenter()).add(t)),this.getZoom()),this;if(this._panAnim||(this._panAnim=new Cn,this._panAnim.on({step:this._onPanTransitionStep,end:this._onPanTransitionEnd},this)),e.noMoveStart||this.fire("movestart"),e.animate!==!1){A(this._mapPane,"leaflet-pan-anim");var i=this._getMapPanePos().subtract(t).round();this._panAnim.run(this._mapPane,i,e.duration||.25,e.easeLinearity)}else this._rawPanBy(t),this.fire("move").fire("moveend");return this},flyTo:function(t,e,i){if(i=i||{},i.animate===!1||!x.any3d)return this.setView(t,e,i);this._stop();var n=this.project(this.getCenter()),o=this.project(t),l=this.getSize(),c=this._zoom;t=I(t),e=e===void 0?c:e;var d=Math.max(l.x,l.y),m=d*this.getZoomScale(c,e),g=o.distanceTo(n)||1,w=1.42,P=w*w;function z(V){var Je=V?-1:1,Cs=V?m:d,As=m*m-d*d+Je*P*P*g*g,zs=2*Cs*P*g,Ii=As/zs,ho=Math.sqrt(Ii*Ii+1)-Ii,Es=ho<1e-9?-18:Math.log(ho);return Es}function et(V){return(Math.exp(V)-Math.exp(-V))/2}function J(V){return(Math.exp(V)+Math.exp(-V))/2}function ut(V){return et(V)/J(V)}var ot=z(0);function Jt(V){return d*(J(ot)/J(ot+w*V))}function Ps(V){return d*(J(ot)*ut(ot+w*V)-et(ot))/P}function Ts(V){return 1-Math.pow(1-V,1.5)}var Ss=Date.now(),ao=(z(1)-ot)/w,Ms=i.duration?1e3*i.duration:1e3*ao*.8;function lo(){var V=(Date.now()-Ss)/Ms,Je=Ts(V)*ao;V<=1?(this._flyToFrame=tt(lo,this),this._move(this.unproject(n.add(o.subtract(n).multiplyBy(Ps(Je)/g)),c),this.getScaleZoom(d/Jt(Je),c),{flyTo:!0})):this._move(t,e)._moveEnd(!0)}return this._moveStart(!0,i.noMoveStart),lo.call(this),this},flyToBounds:function(t,e){var i=this._getBoundsCenterZoom(t,e);return this.flyTo(i.center,i.zoom,e)},setMaxBounds:function(t){return t=j(t),this.listens("moveend",this._panInsideMaxBounds)&&this.off("moveend",this._panInsideMaxBounds),t.isValid()?(this.options.maxBounds=t,this._loaded&&this._panInsideMaxBounds(),this.on("moveend",this._panInsideMaxBounds)):(this.options.maxBounds=null,this)},setMinZoom:function(t){var e=this.options.minZoom;return this.options.minZoom=t,this._loaded&&e!==t&&(this.fire("zoomlevelschange"),this.getZoom()<this.options.minZoom)?this.setZoom(t):this},setMaxZoom:function(t){var e=this.options.maxZoom;return this.options.maxZoom=t,this._loaded&&e!==t&&(this.fire("zoomlevelschange"),this.getZoom()>this.options.maxZoom)?this.setZoom(t):this},panInsideBounds:function(t,e){this._enforcingBounds=!0;var i=this.getCenter(),n=this._limitCenter(i,this._zoom,j(t));return i.equals(n)||this.panTo(n,e),this._enforcingBounds=!1,this},panInside:function(t,e){e=e||{};var i=T(e.paddingTopLeft||e.padding||[0,0]),n=T(e.paddingBottomRight||e.padding||[0,0]),o=this.project(this.getCenter()),l=this.project(t),c=this.getPixelBounds(),d=it([c.min.add(i),c.max.subtract(n)]),m=d.getSize();if(!d.contains(l)){this._enforcingBounds=!0;var g=l.subtract(d.getCenter()),w=d.extend(l).getSize().subtract(m);o.x+=g.x<0?-w.x:w.x,o.y+=g.y<0?-w.y:w.y,this.panTo(this.unproject(o),e),this._enforcingBounds=!1}return this},invalidateSize:function(t){if(!this._loaded)return this;t=u({animate:!1,pan:!0},t===!0?{animate:!0}:t);var e=this.getSize();this._sizeChanged=!0,this._lastCenter=null;var i=this.getSize(),n=e.divideBy(2).round(),o=i.divideBy(2).round(),l=n.subtract(o);return!l.x&&!l.y?this:(t.animate&&t.pan?this.panBy(l):(t.pan&&this._rawPanBy(l),this.fire("move"),t.debounceMoveend?(clearTimeout(this._sizeTimer),this._sizeTimer=setTimeout(f(this.fire,this,"moveend"),200)):this.fire("moveend")),this.fire("resize",{oldSize:e,newSize:i}))},stop:function(){return this.setZoom(this._limitZoom(this._zoom)),this.options.zoomSnap||this.fire("viewreset"),this._stop()},locate:function(t){if(t=this._locateOptions=u({timeout:1e4,watch:!1},t),!("geolocation"in navigator))return this._handleGeolocationError({code:0,message:"Geolocation not supported."}),this;var e=f(this._handleGeolocationResponse,this),i=f(this._handleGeolocationError,this);return t.watch?this._locationWatchId=navigator.geolocation.watchPosition(e,i,t):navigator.geolocation.getCurrentPosition(e,i,t),this},stopLocate:function(){return navigator.geolocation&&navigator.geolocation.clearWatch&&navigator.geolocation.clearWatch(this._locationWatchId),this._locateOptions&&(this._locateOptions.setView=!1),this},_handleGeolocationError:function(t){if(this._container._leaflet_id){var e=t.code,i=t.message||(e===1?"permission denied":e===2?"position unavailable":"timeout");this._locateOptions.setView&&!this._loaded&&this.fitWorld(),this.fire("locationerror",{code:e,message:"Geolocation error: "+i+"."})}},_handleGeolocationResponse:function(t){if(this._container._leaflet_id){var e=t.coords.latitude,i=t.coords.longitude,n=new N(e,i),o=n.toBounds(t.coords.accuracy*2),l=this._locateOptions;if(l.setView){var c=this.getBoundsZoom(o);this.setView(n,l.maxZoom?Math.min(c,l.maxZoom):c)}var d={latlng:n,bounds:o,timestamp:t.timestamp};for(var m in t.coords)typeof t.coords[m]=="number"&&(d[m]=t.coords[m]);this.fire("locationfound",d)}},addHandler:function(t,e){if(!e)return this;var i=this[t]=new e(this);return this._handlers.push(i),this.options[t]&&i.enable(),this},remove:function(){if(this._initEvents(!0),this.options.maxBounds&&this.off("moveend",this._panInsideMaxBounds),this._containerId!==this._container._leaflet_id)throw new Error("Map container is being reused by another instance");try{delete this._container._leaflet_id,delete this._containerId}catch{this._container._leaflet_id=void 0,this._containerId=void 0}this._locationWatchId!==void 0&&this.stopLocate(),this._stop(),H(this._mapPane),this._clearControlPos&&this._clearControlPos(),this._resizeRequest&&(at(this._resizeRequest),this._resizeRequest=null),this._clearHandlers(),this._loaded&&this.fire("unload");var t;for(t in this._layers)this._layers[t].remove();for(t in this._panes)H(this._panes[t]);return this._layers=[],this._panes=[],delete this._mapPane,delete this._renderer,this},createPane:function(t,e){var i="leaflet-pane"+(t?" leaflet-"+t.replace("Pane","")+"-pane":""),n=Z("div",i,e||this._mapPane);return t&&(this._panes[t]=n),n},getCenter:function(){return this._checkIfLoaded(),this._lastCenter&&!this._moved()?this._lastCenter.clone():this.layerPointToLatLng(this._getCenterLayerPoint())},getZoom:function(){return this._zoom},getBounds:function(){var t=this.getPixelBounds(),e=this.unproject(t.getBottomLeft()),i=this.unproject(t.getTopRight());return new nt(e,i)},getMinZoom:function(){return this.options.minZoom===void 0?this._layersMinZoom||0:this.options.minZoom},getMaxZoom:function(){return this.options.maxZoom===void 0?this._layersMaxZoom===void 0?1/0:this._layersMaxZoom:this.options.maxZoom},getBoundsZoom:function(t,e,i){t=j(t),i=T(i||[0,0]);var n=this.getZoom()||0,o=this.getMinZoom(),l=this.getMaxZoom(),c=t.getNorthWest(),d=t.getSouthEast(),m=this.getSize().subtract(i),g=it(this.project(d,n),this.project(c,n)).getSize(),w=x.any3d?this.options.zoomSnap:1,P=m.x/g.x,z=m.y/g.y,et=e?Math.max(P,z):Math.min(P,z);return n=this.getScaleZoom(et,n),w&&(n=Math.round(n/(w/100))*(w/100),n=e?Math.ceil(n/w)*w:Math.floor(n/w)*w),Math.max(o,Math.min(l,n))},getSize:function(){return(!this._size||this._sizeChanged)&&(this._size=new M(this._container.clientWidth||0,this._container.clientHeight||0),this._sizeChanged=!1),this._size.clone()},getPixelBounds:function(t,e){var i=this._getTopLeftPoint(t,e);return new F(i,i.add(this.getSize()))},getPixelOrigin:function(){return this._checkIfLoaded(),this._pixelOrigin},getPixelWorldBounds:function(t){return this.options.crs.getProjectedBounds(t===void 0?this.getZoom():t)},getPane:function(t){return typeof t=="string"?this._panes[t]:t},getPanes:function(){return this._panes},getContainer:function(){return this._container},getZoomScale:function(t,e){var i=this.options.crs;return e=e===void 0?this._zoom:e,i.scale(t)/i.scale(e)},getScaleZoom:function(t,e){var i=this.options.crs;e=e===void 0?this._zoom:e;var n=i.zoom(t*i.scale(e));return isNaN(n)?1/0:n},project:function(t,e){return e=e===void 0?this._zoom:e,this.options.crs.latLngToPoint(I(t),e)},unproject:function(t,e){return e=e===void 0?this._zoom:e,this.options.crs.pointToLatLng(T(t),e)},layerPointToLatLng:function(t){var e=T(t).add(this.getPixelOrigin());return this.unproject(e)},latLngToLayerPoint:function(t){var e=this.project(I(t))._round();return e._subtract(this.getPixelOrigin())},wrapLatLng:function(t){return this.options.crs.wrapLatLng(I(t))},wrapLatLngBounds:function(t){return this.options.crs.wrapLatLngBounds(j(t))},distance:function(t,e){return this.options.crs.distance(I(t),I(e))},containerPointToLayerPoint:function(t){return T(t).subtract(this._getMapPanePos())},layerPointToContainerPoint:function(t){return T(t).add(this._getMapPanePos())},containerPointToLatLng:function(t){var e=this.containerPointToLayerPoint(T(t));return this.layerPointToLatLng(e)},latLngToContainerPoint:function(t){return this.layerPointToContainerPoint(this.latLngToLayerPoint(I(t)))},mouseEventToContainerPoint:function(t){return Sn(t,this._container)},mouseEventToLayerPoint:function(t){return this.containerPointToLayerPoint(this.mouseEventToContainerPoint(t))},mouseEventToLatLng:function(t){return this.layerPointToLatLng(this.mouseEventToLayerPoint(t))},_initContainer:function(t){var e=this._container=kn(t);if(e){if(e._leaflet_id)throw new Error("Map container is already initialized.")}else throw new Error("Map container not found.");C(e,"scroll",this._onScroll,this),this._containerId=_(e)},_initLayout:function(){var t=this._container;this._fadeAnimated=this.options.fadeAnimation&&x.any3d,A(t,"leaflet-container"+(x.touch?" leaflet-touch":"")+(x.retina?" leaflet-retina":"")+(x.ielt9?" leaflet-oldie":"")+(x.safari?" leaflet-safari":"")+(this._fadeAnimated?" leaflet-fade-anim":""));var e=ae(t,"position");e!=="absolute"&&e!=="relative"&&e!=="fixed"&&e!=="sticky"&&(t.style.position="relative"),this._initPanes(),this._initControlPos&&this._initControlPos()},_initPanes:function(){var t=this._panes={};this._paneRenderers={},this._mapPane=this.createPane("mapPane",this._container),G(this._mapPane,new M(0,0)),this.createPane("tilePane"),this.createPane("overlayPane"),this.createPane("shadowPane"),this.createPane("markerPane"),this.createPane("tooltipPane"),this.createPane("popupPane"),this.options.markerZoomAnimation||(A(t.markerPane,"leaflet-zoom-hide"),A(t.shadowPane,"leaflet-zoom-hide"))},_resetView:function(t,e,i){G(this._mapPane,new M(0,0));var n=!this._loaded;this._loaded=!0,e=this._limitZoom(e),this.fire("viewprereset");var o=this._zoom!==e;this._moveStart(o,i)._move(t,e)._moveEnd(o),this.fire("viewreset"),n&&this.fire("load")},_moveStart:function(t,e){return t&&this.fire("zoomstart"),e||this.fire("movestart"),this},_move:function(t,e,i,n){e===void 0&&(e=this._zoom);var o=this._zoom!==e;return this._zoom=e,this._lastCenter=t,this._pixelOrigin=this._getNewPixelOrigin(t),n?i&&i.pinch&&this.fire("zoom",i):((o||i&&i.pinch)&&this.fire("zoom",i),this.fire("move",i)),this},_moveEnd:function(t){return t&&this.fire("zoomend"),this.fire("moveend")},_stop:function(){return at(this._flyToFrame),this._panAnim&&this._panAnim.stop(),this},_rawPanBy:function(t){G(this._mapPane,this._getMapPanePos().subtract(t))},_getZoomSpan:function(){return this.getMaxZoom()-this.getMinZoom()},_panInsideMaxBounds:function(){this._enforcingBounds||this.panInsideBounds(this.options.maxBounds)},_checkIfLoaded:function(){if(!this._loaded)throw new Error("Set map center and zoom first.")},_initEvents:function(t){this._targets={},this._targets[_(this._container)]=this;var e=t?D:C;e(this._container,"click dblclick mousedown mouseup mouseover mouseout mousemove contextmenu keypress keydown keyup",this._handleDOMEvent,this),this.options.trackResize&&e(window,"resize",this._onResize,this),x.any3d&&this.options.transform3DLimit&&(t?this.off:this.on).call(this,"moveend",this._onMoveEnd)},_onResize:function(){at(this._resizeRequest),this._resizeRequest=tt(function(){this.invalidateSize({debounceMoveend:!0})},this)},_onScroll:function(){this._container.scrollTop=0,this._container.scrollLeft=0},_onMoveEnd:function(){var t=this._getMapPanePos();Math.max(Math.abs(t.x),Math.abs(t.y))>=this.options.transform3DLimit&&this._resetView(this.getCenter(),this.getZoom())},_findEventTargets:function(t,e){for(var i=[],n,o=e==="mouseout"||e==="mouseover",l=t.target||t.srcElement,c=!1;l;){if(n=this._targets[_(l)],n&&(e==="click"||e==="preclick")&&this._draggableMoved(n)){c=!0;break}if(n&&n.listens(e,!0)&&(o&&!Li(l,t)||(i.push(n),o))||l===this._container)break;l=l.parentNode}return!i.length&&!c&&!o&&this.listens(e,!0)&&(i=[this]),i},_isClickDisabled:function(t){for(;t&&t!==this._container;){if(t._leaflet_disable_click)return!0;t=t.parentNode}},_handleDOMEvent:function(t){var e=t.target||t.srcElement;if(!(!this._loaded||e._leaflet_disable_events||t.type==="click"&&this._isClickDisabled(e))){var i=t.type;i==="mousedown"&&vi(e),this._fireDOMEvent(t,i)}},_mouseEvents:["click","dblclick","mouseover","mouseout","contextmenu"],_fireDOMEvent:function(t,e,i){if(t.type==="click"){var n=u({},t);n.type="preclick",this._fireDOMEvent(n,n.type,i)}var o=this._findEventTargets(t,e);if(i){for(var l=[],c=0;c<i.length;c++)i[c].listens(e,!0)&&l.push(i[c]);o=l.concat(o)}if(o.length){e==="contextmenu"&&X(t);var d=o[0],m={originalEvent:t};if(t.type!=="keypress"&&t.type!=="keydown"&&t.type!=="keyup"){var g=d.getLatLng&&(!d._radius||d._radius<=10);m.containerPoint=g?this.latLngToContainerPoint(d.getLatLng()):this.mouseEventToContainerPoint(t),m.layerPoint=this.containerPointToLayerPoint(m.containerPoint),m.latlng=g?d.getLatLng():this.layerPointToLatLng(m.layerPoint)}for(c=0;c<o.length;c++)if(o[c].fire(e,m,!0),m.originalEvent._stopped||o[c].options.bubblingMouseEvents===!1&&te(this._mouseEvents,e)!==-1)return}},_draggableMoved:function(t){return t=t.dragging&&t.dragging.enabled()?t:this,t.dragging&&t.dragging.moved()||this.boxZoom&&this.boxZoom.moved()},_clearHandlers:function(){for(var t=0,e=this._handlers.length;t<e;t++)this._handlers[t].disable()},whenReady:function(t,e){return this._loaded?t.call(e||this,{target:this}):this.on("load",t,e),this},_getMapPanePos:function(){return Et(this._mapPane)||new M(0,0)},_moved:function(){var t=this._getMapPanePos();return t&&!t.equals([0,0])},_getTopLeftPoint:function(t,e){var i=t&&e!==void 0?this._getNewPixelOrigin(t,e):this.getPixelOrigin();return i.subtract(this._getMapPanePos())},_getNewPixelOrigin:function(t,e){var i=this.getSize()._divideBy(2);return this.project(t,e)._subtract(i)._add(this._getMapPanePos())._round()},_latLngToNewLayerPoint:function(t,e,i){var n=this._getNewPixelOrigin(i,e);return this.project(t,e)._subtract(n)},_latLngBoundsToNewLayerBounds:function(t,e,i){var n=this._getNewPixelOrigin(i,e);return it([this.project(t.getSouthWest(),e)._subtract(n),this.project(t.getNorthWest(),e)._subtract(n),this.project(t.getSouthEast(),e)._subtract(n),this.project(t.getNorthEast(),e)._subtract(n)])},_getCenterLayerPoint:function(){return this.containerPointToLayerPoint(this.getSize()._divideBy(2))},_getCenterOffset:function(t){return this.latLngToLayerPoint(t).subtract(this._getCenterLayerPoint())},_limitCenter:function(t,e,i){if(!i)return t;var n=this.project(t,e),o=this.getSize().divideBy(2),l=new F(n.subtract(o),n.add(o)),c=this._getBoundsOffset(l,i,e);return Math.abs(c.x)<=1&&Math.abs(c.y)<=1?t:this.unproject(n.add(c),e)},_limitOffset:function(t,e){if(!e)return t;var i=this.getPixelBounds(),n=new F(i.min.add(t),i.max.add(t));return t.add(this._getBoundsOffset(n,e))},_getBoundsOffset:function(t,e,i){var n=it(this.project(e.getNorthEast(),i),this.project(e.getSouthWest(),i)),o=n.min.subtract(t.min),l=n.max.subtract(t.max),c=this._rebound(o.x,-l.x),d=this._rebound(o.y,-l.y);return new M(c,d)},_rebound:function(t,e){return t+e>0?Math.round(t-e)/2:Math.max(0,Math.ceil(t))-Math.max(0,Math.floor(e))},_limitZoom:function(t){var e=this.getMinZoom(),i=this.getMaxZoom(),n=x.any3d?this.options.zoomSnap:1;return n&&(t=Math.round(t/n)*n),Math.max(e,Math.min(i,t))},_onPanTransitionStep:function(){this.fire("move")},_onPanTransitionEnd:function(){q(this._mapPane,"leaflet-pan-anim"),this.fire("moveend")},_tryAnimatedPan:function(t,e){var i=this._getCenterOffset(t)._trunc();return(e&&e.animate)!==!0&&!this.getSize().contains(i)?!1:(this.panBy(i,e),!0)},_createAnimProxy:function(){var t=this._proxy=Z("div","leaflet-proxy leaflet-zoom-animated");this._panes.mapPane.appendChild(t),this.on("zoomanim",function(e){var i=ci,n=this._proxy.style[i];zt(this._proxy,this.project(e.center,e.zoom),this.getZoomScale(e.zoom,1)),n===this._proxy.style[i]&&this._animatingZoom&&this._onZoomTransitionEnd()},this),this.on("load moveend",this._animMoveEnd,this),this._on("unload",this._destroyAnimProxy,this)},_destroyAnimProxy:function(){H(this._proxy),this.off("load moveend",this._animMoveEnd,this),delete this._proxy},_animMoveEnd:function(){var t=this.getCenter(),e=this.getZoom();zt(this._proxy,this.project(t,e),this.getZoomScale(e,1))},_catchTransitionEnd:function(t){this._animatingZoom&&t.propertyName.indexOf("transform")>=0&&this._onZoomTransitionEnd()},_nothingToAnimate:function(){return!this._container.getElementsByClassName("leaflet-zoom-animated").length},_tryAnimatedZoom:function(t,e,i){if(this._animatingZoom)return!0;if(i=i||{},!this._zoomAnimated||i.animate===!1||this._nothingToAnimate()||Math.abs(e-this._zoom)>this.options.zoomAnimationThreshold)return!1;var n=this.getZoomScale(e),o=this._getCenterOffset(t)._divideBy(1-1/n);return i.animate!==!0&&!this.getSize().contains(o)?!1:(tt(function(){this._moveStart(!0,i.noMoveStart||!1)._animateZoom(t,e,!0)},this),!0)},_animateZoom:function(t,e,i,n){this._mapPane&&(i&&(this._animatingZoom=!0,this._animateToCenter=t,this._animateToZoom=e,A(this._mapPane,"leaflet-zoom-anim")),this.fire("zoomanim",{center:t,zoom:e,noUpdate:n}),this._tempFireZoomEvent||(this._tempFireZoomEvent=this._zoom!==this._animateToZoom),this._move(this._animateToCenter,this._animateToZoom,void 0,!0),setTimeout(f(this._onZoomTransitionEnd,this),250))},_onZoomTransitionEnd:function(){this._animatingZoom&&(this._mapPane&&q(this._mapPane,"leaflet-zoom-anim"),this._animatingZoom=!1,this._move(this._animateToCenter,this._animateToZoom,void 0,!0),this._tempFireZoomEvent&&this.fire("zoom"),delete this._tempFireZoomEvent,this.fire("move"),this._moveEnd(!0))}});function Hr(t,e){return new B(t,e)}var ct=yt.extend({options:{position:"topright"},initialize:function(t){O(this,t)},getPosition:function(){return this.options.position},setPosition:function(t){var e=this._map;return e&&e.removeControl(this),this.options.position=t,e&&e.addControl(this),this},getContainer:function(){return this._container},addTo:function(t){this.remove(),this._map=t;var e=this._container=this.onAdd(t),i=this.getPosition(),n=t._controlCorners[i];return A(e,"leaflet-control"),i.indexOf("bottom")!==-1?n.insertBefore(e,n.firstChild):n.appendChild(e),this._map.on("unload",this.remove,this),this},remove:function(){return this._map?(H(this._container),this.onRemove&&this.onRemove(this._map),this._map.off("unload",this.remove,this),this._map=null,this):this},_refocusOnMap:function(t){this._map&&t&&t.screenX>0&&t.screenY>0&&this._map.getContainer().focus()}}),de=function(t){return new ct(t)};B.include({addControl:function(t){return t.addTo(this),this},removeControl:function(t){return t.remove(),this},_initControlPos:function(){var t=this._controlCorners={},e="leaflet-",i=this._controlContainer=Z("div",e+"control-container",this._container);function n(o,l){var c=e+o+" "+e+l;t[o+l]=Z("div",c,i)}n("top","left"),n("top","right"),n("bottom","left"),n("bottom","right")},_clearControlPos:function(){for(var t in this._controlCorners)H(this._controlCorners[t]);H(this._controlContainer),delete this._controlCorners,delete this._controlContainer}});var An=ct.extend({options:{collapsed:!0,position:"topright",autoZIndex:!0,hideSingleBase:!1,sortLayers:!1,sortFunction:function(t,e,i,n){return i<n?-1:n<i?1:0}},initialize:function(t,e,i){O(this,i),this._layerControlInputs=[],this._layers=[],this._lastZIndex=0,this._handlingClick=!1,this._preventClick=!1;for(var n in t)this._addLayer(t[n],n);for(n in e)this._addLayer(e[n],n,!0)},onAdd:function(t){this._initLayout(),this._update(),this._map=t,t.on("zoomend",this._checkDisabledLayers,this);for(var e=0;e<this._layers.length;e++)this._layers[e].layer.on("add remove",this._onLayerChange,this);return this._container},addTo:function(t){return ct.prototype.addTo.call(this,t),this._expandIfNotCollapsed()},onRemove:function(){this._map.off("zoomend",this._checkDisabledLayers,this);for(var t=0;t<this._layers.length;t++)this._layers[t].layer.off("add remove",this._onLayerChange,this)},addBaseLayer:function(t,e){return this._addLayer(t,e),this._map?this._update():this},addOverlay:function(t,e){return this._addLayer(t,e,!0),this._map?this._update():this},removeLayer:function(t){t.off("add remove",this._onLayerChange,this);var e=this._getLayer(_(t));return e&&this._layers.splice(this._layers.indexOf(e),1),this._map?this._update():this},expand:function(){A(this._container,"leaflet-control-layers-expanded"),this._section.style.height=null;var t=this._map.getSize().y-(this._container.offsetTop+50);return t<this._section.clientHeight?(A(this._section,"leaflet-control-layers-scrollbar"),this._section.style.height=t+"px"):q(this._section,"leaflet-control-layers-scrollbar"),this._checkDisabledLayers(),this},collapse:function(){return q(this._container,"leaflet-control-layers-expanded"),this},_initLayout:function(){var t="leaflet-control-layers",e=this._container=Z("div",t),i=this.options.collapsed;e.setAttribute("aria-haspopup",!0),ce(e),ki(e);var n=this._section=Z("section",t+"-list");i&&(this._map.on("click",this.collapse,this),C(e,{mouseenter:this._expandSafely,mouseleave:this.collapse},this));var o=this._layersLink=Z("a",t+"-toggle",e);o.href="#",o.title="Layers",o.setAttribute("role","button"),C(o,{keydown:function(l){l.keyCode===13&&this._expandSafely()},click:function(l){X(l),this._expandSafely()}},this),i||this.expand(),this._baseLayersList=Z("div",t+"-base",n),this._separator=Z("div",t+"-separator",n),this._overlaysList=Z("div",t+"-overlays",n),e.appendChild(n)},_getLayer:function(t){for(var e=0;e<this._layers.length;e++)if(this._layers[e]&&_(this._layers[e].layer)===t)return this._layers[e]},_addLayer:function(t,e,i){this._map&&t.on("add remove",this._onLayerChange,this),this._layers.push({layer:t,name:e,overlay:i}),this.options.sortLayers&&this._layers.sort(f(function(n,o){return this.options.sortFunction(n.layer,o.layer,n.name,o.name)},this)),this.options.autoZIndex&&t.setZIndex&&(this._lastZIndex++,t.setZIndex(this._lastZIndex)),this._expandIfNotCollapsed()},_update:function(){if(!this._container)return this;Ie(this._baseLayersList),Ie(this._overlaysList),this._layerControlInputs=[];var t,e,i,n,o=0;for(i=0;i<this._layers.length;i++)n=this._layers[i],this._addItem(n),e=e||n.overlay,t=t||!n.overlay,o+=n.overlay?0:1;return this.options.hideSingleBase&&(t=t&&o>1,this._baseLayersList.style.display=t?"":"none"),this._separator.style.display=e&&t?"":"none",this},_onLayerChange:function(t){this._handlingClick||this._update();var e=this._getLayer(_(t.target)),i=e.overlay?t.type==="add"?"overlayadd":"overlayremove":t.type==="add"?"baselayerchange":null;i&&this._map.fire(i,e)},_createRadioElement:function(t,e){var i='<input type="radio" class="leaflet-control-layers-selector" name="'+t+'"'+(e?' checked="checked"':"")+"/>",n=document.createElement("div");return n.innerHTML=i,n.firstChild},_addItem:function(t){var e=document.createElement("label"),i=this._map.hasLayer(t.layer),n;t.overlay?(n=document.createElement("input"),n.type="checkbox",n.className="leaflet-control-layers-selector",n.defaultChecked=i):n=this._createRadioElement("leaflet-base-layers_"+_(this),i),this._layerControlInputs.push(n),n.layerId=_(t.layer),C(n,"click",this._onInputClick,this);var o=document.createElement("span");o.innerHTML=" "+t.name;var l=document.createElement("span");e.appendChild(l),l.appendChild(n),l.appendChild(o);var c=t.overlay?this._overlaysList:this._baseLayersList;return c.appendChild(e),this._checkDisabledLayers(),e},_onInputClick:function(){if(!this._preventClick){var t=this._layerControlInputs,e,i,n=[],o=[];this._handlingClick=!0;for(var l=t.length-1;l>=0;l--)e=t[l],i=this._getLayer(e.layerId).layer,e.checked?n.push(i):e.checked||o.push(i);for(l=0;l<o.length;l++)this._map.hasLayer(o[l])&&this._map.removeLayer(o[l]);for(l=0;l<n.length;l++)this._map.hasLayer(n[l])||this._map.addLayer(n[l]);this._handlingClick=!1,this._refocusOnMap()}},_checkDisabledLayers:function(){for(var t=this._layerControlInputs,e,i,n=this._map.getZoom(),o=t.length-1;o>=0;o--)e=t[o],i=this._getLayer(e.layerId).layer,e.disabled=i.options.minZoom!==void 0&&n<i.options.minZoom||i.options.maxZoom!==void 0&&n>i.options.maxZoom},_expandIfNotCollapsed:function(){return this._map&&!this.options.collapsed&&this.expand(),this},_expandSafely:function(){var t=this._section;this._preventClick=!0,C(t,"click",X),this.expand();var e=this;setTimeout(function(){D(t,"click",X),e._preventClick=!1})}}),Ur=function(t,e,i){return new An(t,e,i)},Pi=ct.extend({options:{position:"topleft",zoomInText:'<span aria-hidden="true">+</span>',zoomInTitle:"Zoom in",zoomOutText:'<span aria-hidden="true">&#x2212;</span>',zoomOutTitle:"Zoom out"},onAdd:function(t){var e="leaflet-control-zoom",i=Z("div",e+" leaflet-bar"),n=this.options;return this._zoomInButton=this._createButton(n.zoomInText,n.zoomInTitle,e+"-in",i,this._zoomIn),this._zoomOutButton=this._createButton(n.zoomOutText,n.zoomOutTitle,e+"-out",i,this._zoomOut),this._updateDisabled(),t.on("zoomend zoomlevelschange",this._updateDisabled,this),i},onRemove:function(t){t.off("zoomend zoomlevelschange",this._updateDisabled,this)},disable:function(){return this._disabled=!0,this._updateDisabled(),this},enable:function(){return this._disabled=!1,this._updateDisabled(),this},_zoomIn:function(t){!this._disabled&&this._map._zoom<this._map.getMaxZoom()&&this._map.zoomIn(this._map.options.zoomDelta*(t.shiftKey?3:1))},_zoomOut:function(t){!this._disabled&&this._map._zoom>this._map.getMinZoom()&&this._map.zoomOut(this._map.options.zoomDelta*(t.shiftKey?3:1))},_createButton:function(t,e,i,n,o){var l=Z("a",i,n);return l.innerHTML=t,l.href="#",l.title=e,l.setAttribute("role","button"),l.setAttribute("aria-label",e),ce(l),C(l,"click",$t),C(l,"click",o,this),C(l,"click",this._refocusOnMap,this),l},_updateDisabled:function(){var t=this._map,e="leaflet-disabled";q(this._zoomInButton,e),q(this._zoomOutButton,e),this._zoomInButton.setAttribute("aria-disabled","false"),this._zoomOutButton.setAttribute("aria-disabled","false"),(this._disabled||t._zoom===t.getMinZoom())&&(A(this._zoomOutButton,e),this._zoomOutButton.setAttribute("aria-disabled","true")),(this._disabled||t._zoom===t.getMaxZoom())&&(A(this._zoomInButton,e),this._zoomInButton.setAttribute("aria-disabled","true"))}});B.mergeOptions({zoomControl:!0}),B.addInitHook(function(){this.options.zoomControl&&(this.zoomControl=new Pi,this.addControl(this.zoomControl))});var Wr=function(t){return new Pi(t)},zn=ct.extend({options:{position:"bottomleft",maxWidth:100,metric:!0,imperial:!0},onAdd:function(t){var e="leaflet-control-scale",i=Z("div",e),n=this.options;return this._addScales(n,e+"-line",i),t.on(n.updateWhenIdle?"moveend":"move",this._update,this),t.whenReady(this._update,this),i},onRemove:function(t){t.off(this.options.updateWhenIdle?"moveend":"move",this._update,this)},_addScales:function(t,e,i){t.metric&&(this._mScale=Z("div",e,i)),t.imperial&&(this._iScale=Z("div",e,i))},_update:function(){var t=this._map,e=t.getSize().y/2,i=t.distance(t.containerPointToLatLng([0,e]),t.containerPointToLatLng([this.options.maxWidth,e]));this._updateScales(i)},_updateScales:function(t){this.options.metric&&t&&this._updateMetric(t),this.options.imperial&&t&&this._updateImperial(t)},_updateMetric:function(t){var e=this._getRoundNum(t),i=e<1e3?e+" m":e/1e3+" km";this._updateScale(this._mScale,i,e/t)},_updateImperial:function(t){var e=t*3.2808399,i,n,o;e>5280?(i=e/5280,n=this._getRoundNum(i),this._updateScale(this._iScale,n+" mi",n/i)):(o=this._getRoundNum(e),this._updateScale(this._iScale,o+" ft",o/e))},_updateScale:function(t,e,i){t.style.width=Math.round(this.options.maxWidth*i)+"px",t.innerHTML=e},_getRoundNum:function(t){var e=Math.pow(10,(Math.floor(t)+"").length-1),i=t/e;return i=i>=10?10:i>=5?5:i>=3?3:i>=2?2:1,e*i}}),qr=function(t){return new zn(t)},jr='<svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="12" height="8" viewBox="0 0 12 8" class="leaflet-attribution-flag"><path fill="#4C7BE1" d="M0 0h12v4H0z"/><path fill="#FFD500" d="M0 4h12v3H0z"/><path fill="#E0BC00" d="M0 7h12v1H0z"/></svg>',Ti=ct.extend({options:{position:"bottomright",prefix:'<a href="https://leafletjs.com" title="A JavaScript library for interactive maps">'+(x.inlineSvg?jr+" ":"")+"Leaflet</a>"},initialize:function(t){O(this,t),this._attributions={}},onAdd:function(t){t.attributionControl=this,this._container=Z("div","leaflet-control-attribution"),ce(this._container);for(var e in t._layers)t._layers[e].getAttribution&&this.addAttribution(t._layers[e].getAttribution());return this._update(),t.on("layeradd",this._addAttribution,this),this._container},onRemove:function(t){t.off("layeradd",this._addAttribution,this)},_addAttribution:function(t){t.layer.getAttribution&&(this.addAttribution(t.layer.getAttribution()),t.layer.once("remove",function(){this.removeAttribution(t.layer.getAttribution())},this))},setPrefix:function(t){return this.options.prefix=t,this._update(),this},addAttribution:function(t){return t?(this._attributions[t]||(this._attributions[t]=0),this._attributions[t]++,this._update(),this):this},removeAttribution:function(t){return t?(this._attributions[t]&&(this._attributions[t]--,this._update()),this):this},_update:function(){if(this._map){var t=[];for(var e in this._attributions)this._attributions[e]&&t.push(e);var i=[];this.options.prefix&&i.push(this.options.prefix),t.length&&i.push(t.join(", ")),this._container.innerHTML=i.join(' <span aria-hidden="true">|</span> ')}}});B.mergeOptions({attributionControl:!0}),B.addInitHook(function(){this.options.attributionControl&&new Ti().addTo(this)});var Gr=function(t){return new Ti(t)};ct.Layers=An,ct.Zoom=Pi,ct.Scale=zn,ct.Attribution=Ti,de.layers=Ur,de.zoom=Wr,de.scale=qr,de.attribution=Gr;var _t=yt.extend({initialize:function(t){this._map=t},enable:function(){return this._enabled?this:(this._enabled=!0,this.addHooks(),this)},disable:function(){return this._enabled?(this._enabled=!1,this.removeHooks(),this):this},enabled:function(){return!!this._enabled}});_t.addTo=function(t,e){return t.addHandler(e,this),this};var Vr={Events:st},En=x.touch?"touchstart mousedown":"mousedown",St=ne.extend({options:{clickTolerance:3},initialize:function(t,e,i,n){O(this,n),this._element=t,this._dragStartTarget=e||t,this._preventOutline=i},enable:function(){this._enabled||(C(this._dragStartTarget,En,this._onDown,this),this._enabled=!0)},disable:function(){this._enabled&&(St._dragging===this&&this.finishDrag(!0),D(this._dragStartTarget,En,this._onDown,this),this._enabled=!1,this._moved=!1)},_onDown:function(t){if(this._enabled&&(this._moved=!1,!di(this._element,"leaflet-zoom-anim"))){if(t.touches&&t.touches.length!==1){St._dragging===this&&this.finishDrag();return}if(!(St._dragging||t.shiftKey||t.which!==1&&t.button!==1&&!t.touches)&&(St._dragging=this,this._preventOutline&&vi(this._element),mi(),le(),!this._moving)){this.fire("down");var e=t.touches?t.touches[0]:t,i=Ln(this._element);this._startPoint=new M(e.clientX,e.clientY),this._startPos=Et(this._element),this._parentScale=yi(i);var n=t.type==="mousedown";C(document,n?"mousemove":"touchmove",this._onMove,this),C(document,n?"mouseup":"touchend touchcancel",this._onUp,this)}}},_onMove:function(t){if(this._enabled){if(t.touches&&t.touches.length>1){this._moved=!0;return}var e=t.touches&&t.touches.length===1?t.touches[0]:t,i=new M(e.clientX,e.clientY)._subtract(this._startPoint);!i.x&&!i.y||Math.abs(i.x)+Math.abs(i.y)<this.options.clickTolerance||(i.x/=this._parentScale.x,i.y/=this._parentScale.y,X(t),this._moved||(this.fire("dragstart"),this._moved=!0,A(document.body,"leaflet-dragging"),this._lastTarget=t.target||t.srcElement,window.SVGElementInstance&&this._lastTarget instanceof window.SVGElementInstance&&(this._lastTarget=this._lastTarget.correspondingUseElement),A(this._lastTarget,"leaflet-drag-target")),this._newPos=this._startPos.add(i),this._moving=!0,this._lastEvent=t,this._updatePosition())}},_updatePosition:function(){var t={originalEvent:this._lastEvent};this.fire("predrag",t),G(this._element,this._newPos),this.fire("drag",t)},_onUp:function(){this._enabled&&this.finishDrag()},finishDrag:function(t){q(document.body,"leaflet-dragging"),this._lastTarget&&(q(this._lastTarget,"leaflet-drag-target"),this._lastTarget=null),D(document,"mousemove touchmove",this._onMove,this),D(document,"mouseup touchend touchcancel",this._onUp,this),_i(),he();var e=this._moved&&this._moving;this._moving=!1,St._dragging=!1,e&&this.fire("dragend",{noInertia:t,distance:this._newPos.distanceTo(this._startPos)})}});function On(t,e,i){var n,o=[1,4,2,8],l,c,d,m,g,w,P,z;for(l=0,w=t.length;l<w;l++)t[l]._code=It(t[l],e);for(d=0;d<4;d++){for(P=o[d],n=[],l=0,w=t.length,c=w-1;l<w;c=l++)m=t[l],g=t[c],m._code&P?g._code&P||(z=De(g,m,P,e,i),z._code=It(z,e),n.push(z)):(g._code&P&&(z=De(g,m,P,e,i),z._code=It(z,e),n.push(z)),n.push(m));t=n}return t}function $n(t,e){var i,n,o,l,c,d,m,g,w;if(!t||t.length===0)throw new Error("latlngs not passed");ht(t)||(console.warn("latlngs are not flat! Only the first ring will be used"),t=t[0]);var P=I([0,0]),z=j(t),et=z.getNorthWest().distanceTo(z.getSouthWest())*z.getNorthEast().distanceTo(z.getNorthWest());et<1700&&(P=Si(t));var J=t.length,ut=[];for(i=0;i<J;i++){var ot=I(t[i]);ut.push(e.project(I([ot.lat-P.lat,ot.lng-P.lng])))}for(d=m=g=0,i=0,n=J-1;i<J;n=i++)o=ut[i],l=ut[n],c=o.y*l.x-l.y*o.x,m+=(o.x+l.x)*c,g+=(o.y+l.y)*c,d+=c*3;d===0?w=ut[0]:w=[m/d,g/d];var Jt=e.unproject(T(w));return I([Jt.lat+P.lat,Jt.lng+P.lng])}function Si(t){for(var e=0,i=0,n=0,o=0;o<t.length;o++){var l=I(t[o]);e+=l.lat,i+=l.lng,n++}return I([e/n,i/n])}var Kr={__proto__:null,clipPolygon:On,polygonCenter:$n,centroid:Si};function In(t,e){if(!e||!t.length)return t.slice();var i=e*e;return t=Xr(t,i),t=Jr(t,i),t}function Bn(t,e,i){return Math.sqrt(pe(t,e,i,!0))}function Yr(t,e,i){return pe(t,e,i)}function Jr(t,e){var i=t.length,n=typeof Uint8Array<"u"?Uint8Array:Array,o=new n(i);o[0]=o[i-1]=1,Mi(t,o,e,0,i-1);var l,c=[];for(l=0;l<i;l++)o[l]&&c.push(t[l]);return c}function Mi(t,e,i,n,o){var l=0,c,d,m;for(d=n+1;d<=o-1;d++)m=pe(t[d],t[n],t[o],!0),m>l&&(c=d,l=m);l>i&&(e[c]=1,Mi(t,e,i,n,c),Mi(t,e,i,c,o))}function Xr(t,e){for(var i=[t[0]],n=1,o=0,l=t.length;n<l;n++)Qr(t[n],t[o])>e&&(i.push(t[n]),o=n);return o<l-1&&i.push(t[l-1]),i}var Zn;function Rn(t,e,i,n,o){var l=n?Zn:It(t,i),c=It(e,i),d,m,g;for(Zn=c;;){if(!(l|c))return[t,e];if(l&c)return!1;d=l||c,m=De(t,e,d,i,o),g=It(m,i),d===l?(t=m,l=g):(e=m,c=g)}}function De(t,e,i,n,o){var l=e.x-t.x,c=e.y-t.y,d=n.min,m=n.max,g,w;return i&8?(g=t.x+l*(m.y-t.y)/c,w=m.y):i&4?(g=t.x+l*(d.y-t.y)/c,w=d.y):i&2?(g=m.x,w=t.y+c*(m.x-t.x)/l):i&1&&(g=d.x,w=t.y+c*(d.x-t.x)/l),new M(g,w,o)}function It(t,e){var i=0;return t.x<e.min.x?i|=1:t.x>e.max.x&&(i|=2),t.y<e.min.y?i|=4:t.y>e.max.y&&(i|=8),i}function Qr(t,e){var i=e.x-t.x,n=e.y-t.y;return i*i+n*n}function pe(t,e,i,n){var o=e.x,l=e.y,c=i.x-o,d=i.y-l,m=c*c+d*d,g;return m>0&&(g=((t.x-o)*c+(t.y-l)*d)/m,g>1?(o=i.x,l=i.y):g>0&&(o+=c*g,l+=d*g)),c=t.x-o,d=t.y-l,n?c*c+d*d:new M(o,l)}function ht(t){return!rt(t[0])||typeof t[0][0]!="object"&&typeof t[0][0]<"u"}function Nn(t){return console.warn("Deprecated use of _flat, please use L.LineUtil.isFlat instead."),ht(t)}function Dn(t,e){var i,n,o,l,c,d,m,g;if(!t||t.length===0)throw new Error("latlngs not passed");ht(t)||(console.warn("latlngs are not flat! Only the first ring will be used"),t=t[0]);var w=I([0,0]),P=j(t),z=P.getNorthWest().distanceTo(P.getSouthWest())*P.getNorthEast().distanceTo(P.getNorthWest());z<1700&&(w=Si(t));var et=t.length,J=[];for(i=0;i<et;i++){var ut=I(t[i]);J.push(e.project(I([ut.lat-w.lat,ut.lng-w.lng])))}for(i=0,n=0;i<et-1;i++)n+=J[i].distanceTo(J[i+1])/2;if(n===0)g=J[0];else for(i=0,l=0;i<et-1;i++)if(c=J[i],d=J[i+1],o=c.distanceTo(d),l+=o,l>n){m=(l-n)/o,g=[d.x-m*(d.x-c.x),d.y-m*(d.y-c.y)];break}var ot=e.unproject(T(g));return I([ot.lat+w.lat,ot.lng+w.lng])}var ts={__proto__:null,simplify:In,pointToSegmentDistance:Bn,closestPointOnSegment:Yr,clipSegment:Rn,_getEdgeIntersection:De,_getBitCode:It,_sqClosestPointOnSegment:pe,isFlat:ht,_flat:Nn,polylineCenter:Dn},Ci={project:function(t){return new M(t.lng,t.lat)},unproject:function(t){return new N(t.y,t.x)},bounds:new F([-180,-90],[180,90])},Ai={R:6378137,R_MINOR:6356752314245179e-9,bounds:new F([-2003750834279e-5,-1549657073972e-5],[2003750834279e-5,1876465623138e-5]),project:function(t){var e=Math.PI/180,i=this.R,n=t.lat*e,o=this.R_MINOR/i,l=Math.sqrt(1-o*o),c=l*Math.sin(n),d=Math.tan(Math.PI/4-n/2)/Math.pow((1-c)/(1+c),l/2);return n=-i*Math.log(Math.max(d,1e-10)),new M(t.lng*e*i,n)},unproject:function(t){for(var e=180/Math.PI,i=this.R,n=this.R_MINOR/i,o=Math.sqrt(1-n*n),l=Math.exp(-t.y/i),c=Math.PI/2-2*Math.atan(l),d=0,m=.1,g;d<15&&Math.abs(m)>1e-7;d++)g=o*Math.sin(c),g=Math.pow((1-g)/(1+g),o/2),m=Math.PI/2-2*Math.atan(l*g)-c,c+=m;return new N(c*e,t.x*e/i)}},es={__proto__:null,LonLat:Ci,Mercator:Ai,SphericalMercator:ii},is=u({},Tt,{code:"EPSG:3395",projection:Ai,transformation:(function(){var t=.5/(Math.PI*Ai.R);return oe(t,.5,-t,.5)})()}),Fn=u({},Tt,{code:"EPSG:4326",projection:Ci,transformation:oe(1/180,1,-1/180,.5)}),ns=u({},wt,{projection:Ci,transformation:oe(1,0,-1,0),scale:function(t){return Math.pow(2,t)},zoom:function(t){return Math.log(t)/Math.LN2},distance:function(t,e){var i=e.lng-t.lng,n=e.lat-t.lat;return Math.sqrt(i*i+n*n)},infinite:!0});wt.Earth=Tt,wt.EPSG3395=is,wt.EPSG3857=oi,wt.EPSG900913=hr,wt.EPSG4326=Fn,wt.Simple=ns;var dt=ne.extend({options:{pane:"overlayPane",attribution:null,bubblingMouseEvents:!0},addTo:function(t){return t.addLayer(this),this},remove:function(){return this.removeFrom(this._map||this._mapToAdd)},removeFrom:function(t){return t&&t.removeLayer(this),this},getPane:function(t){return this._map.getPane(t?this.options[t]||t:this.options.pane)},addInteractiveTarget:function(t){return this._map._targets[_(t)]=this,this},removeInteractiveTarget:function(t){return delete this._map._targets[_(t)],this},getAttribution:function(){return this.options.attribution},_layerAdd:function(t){var e=t.target;if(e.hasLayer(this)){if(this._map=e,this._zoomAnimated=e._zoomAnimated,this.getEvents){var i=this.getEvents();e.on(i,this),this.once("remove",function(){e.off(i,this)},this)}this.onAdd(e),this.fire("add"),e.fire("layeradd",{layer:this})}}});B.include({addLayer:function(t){if(!t._layerAdd)throw new Error("The provided object is not a Layer.");var e=_(t);return this._layers[e]?this:(this._layers[e]=t,t._mapToAdd=this,t.beforeAdd&&t.beforeAdd(this),this.whenReady(t._layerAdd,t),this)},removeLayer:function(t){var e=_(t);return this._layers[e]?(this._loaded&&t.onRemove(this),delete this._layers[e],this._loaded&&(this.fire("layerremove",{layer:t}),t.fire("remove")),t._map=t._mapToAdd=null,this):this},hasLayer:function(t){return _(t)in this._layers},eachLayer:function(t,e){for(var i in this._layers)t.call(e,this._layers[i]);return this},_addLayers:function(t){t=t?rt(t)?t:[t]:[];for(var e=0,i=t.length;e<i;e++)this.addLayer(t[e])},_addZoomLimit:function(t){(!isNaN(t.options.maxZoom)||!isNaN(t.options.minZoom))&&(this._zoomBoundLayers[_(t)]=t,this._updateZoomLevels())},_removeZoomLimit:function(t){var e=_(t);this._zoomBoundLayers[e]&&(delete this._zoomBoundLayers[e],this._updateZoomLevels())},_updateZoomLevels:function(){var t=1/0,e=-1/0,i=this._getZoomSpan();for(var n in this._zoomBoundLayers){var o=this._zoomBoundLayers[n].options;t=o.minZoom===void 0?t:Math.min(t,o.minZoom),e=o.maxZoom===void 0?e:Math.max(e,o.maxZoom)}this._layersMaxZoom=e===-1/0?void 0:e,this._layersMinZoom=t===1/0?void 0:t,i!==this._getZoomSpan()&&this.fire("zoomlevelschange"),this.options.maxZoom===void 0&&this._layersMaxZoom&&this.getZoom()>this._layersMaxZoom&&this.setZoom(this._layersMaxZoom),this.options.minZoom===void 0&&this._layersMinZoom&&this.getZoom()<this._layersMinZoom&&this.setZoom(this._layersMinZoom)}});var jt=dt.extend({initialize:function(t,e){O(this,e),this._layers={};var i,n;if(t)for(i=0,n=t.length;i<n;i++)this.addLayer(t[i])},addLayer:function(t){var e=this.getLayerId(t);return this._layers[e]=t,this._map&&this._map.addLayer(t),this},removeLayer:function(t){var e=t in this._layers?t:this.getLayerId(t);return this._map&&this._layers[e]&&this._map.removeLayer(this._layers[e]),delete this._layers[e],this},hasLayer:function(t){var e=typeof t=="number"?t:this.getLayerId(t);return e in this._layers},clearLayers:function(){return this.eachLayer(this.removeLayer,this)},invoke:function(t){var e=Array.prototype.slice.call(arguments,1),i,n;for(i in this._layers)n=this._layers[i],n[t]&&n[t].apply(n,e);return this},onAdd:function(t){this.eachLayer(t.addLayer,t)},onRemove:function(t){this.eachLayer(t.removeLayer,t)},eachLayer:function(t,e){for(var i in this._layers)t.call(e,this._layers[i]);return this},getLayer:function(t){return this._layers[t]},getLayers:function(){var t=[];return this.eachLayer(t.push,t),t},setZIndex:function(t){return this.invoke("setZIndex",t)},getLayerId:function(t){return _(t)}}),os=function(t,e){return new jt(t,e)},bt=jt.extend({addLayer:function(t){return this.hasLayer(t)?this:(t.addEventParent(this),jt.prototype.addLayer.call(this,t),this.fire("layeradd",{layer:t}))},removeLayer:function(t){return this.hasLayer(t)?(t in this._layers&&(t=this._layers[t]),t.removeEventParent(this),jt.prototype.removeLayer.call(this,t),this.fire("layerremove",{layer:t})):this},setStyle:function(t){return this.invoke("setStyle",t)},bringToFront:function(){return this.invoke("bringToFront")},bringToBack:function(){return this.invoke("bringToBack")},getBounds:function(){var t=new nt;for(var e in this._layers){var i=this._layers[e];t.extend(i.getBounds?i.getBounds():i.getLatLng())}return t}}),rs=function(t,e){return new bt(t,e)},Gt=yt.extend({options:{popupAnchor:[0,0],tooltipAnchor:[0,0],crossOrigin:!1},initialize:function(t){O(this,t)},createIcon:function(t){return this._createIcon("icon",t)},createShadow:function(t){return this._createIcon("shadow",t)},_createIcon:function(t,e){var i=this._getIconUrl(t);if(!i){if(t==="icon")throw new Error("iconUrl not set in Icon options (see the docs).");return null}var n=this._createImg(i,e&&e.tagName==="IMG"?e:null);return this._setIconStyles(n,t),(this.options.crossOrigin||this.options.crossOrigin==="")&&(n.crossOrigin=this.options.crossOrigin===!0?"":this.options.crossOrigin),n},_setIconStyles:function(t,e){var i=this.options,n=i[e+"Size"];typeof n=="number"&&(n=[n,n]);var o=T(n),l=T(e==="shadow"&&i.shadowAnchor||i.iconAnchor||o&&o.divideBy(2,!0));t.className="leaflet-marker-"+e+" "+(i.className||""),l&&(t.style.marginLeft=-l.x+"px",t.style.marginTop=-l.y+"px"),o&&(t.style.width=o.x+"px",t.style.height=o.y+"px")},_createImg:function(t,e){return e=e||document.createElement("img"),e.src=t,e},_getIconUrl:function(t){return x.retina&&this.options[t+"RetinaUrl"]||this.options[t+"Url"]}});function ss(t){return new Gt(t)}var fe=Gt.extend({options:{iconUrl:"marker-icon.png",iconRetinaUrl:"marker-icon-2x.png",shadowUrl:"marker-shadow.png",iconSize:[25,41],iconAnchor:[12,41],popupAnchor:[1,-34],tooltipAnchor:[16,-28],shadowSize:[41,41]},_getIconUrl:function(t){return typeof fe.imagePath!="string"&&(fe.imagePath=this._detectIconPath()),(this.options.imagePath||fe.imagePath)+Gt.prototype._getIconUrl.call(this,t)},_stripUrl:function(t){var e=function(i,n,o){var l=n.exec(i);return l&&l[o]};return t=e(t,/^url\((['"])?(.+)\1\)$/,2),t&&e(t,/^(.*)marker-icon\.png$/,1)},_detectIconPath:function(){var t=Z("div","leaflet-default-icon-path",document.body),e=ae(t,"background-image")||ae(t,"backgroundImage");if(document.body.removeChild(t),e=this._stripUrl(e),e)return e;var i=document.querySelector('link[href$="leaflet.css"]');return i?i.href.substring(0,i.href.length-11-1):""}}),Hn=_t.extend({initialize:function(t){this._marker=t},addHooks:function(){var t=this._marker._icon;this._draggable||(this._draggable=new St(t,t,!0)),this._draggable.on({dragstart:this._onDragStart,predrag:this._onPreDrag,drag:this._onDrag,dragend:this._onDragEnd},this).enable(),A(t,"leaflet-marker-draggable")},removeHooks:function(){this._draggable.off({dragstart:this._onDragStart,predrag:this._onPreDrag,drag:this._onDrag,dragend:this._onDragEnd},this).disable(),this._marker._icon&&q(this._marker._icon,"leaflet-marker-draggable")},moved:function(){return this._draggable&&this._draggable._moved},_adjustPan:function(t){var e=this._marker,i=e._map,n=this._marker.options.autoPanSpeed,o=this._marker.options.autoPanPadding,l=Et(e._icon),c=i.getPixelBounds(),d=i.getPixelOrigin(),m=it(c.min._subtract(d).add(o),c.max._subtract(d).subtract(o));if(!m.contains(l)){var g=T((Math.max(m.max.x,l.x)-m.max.x)/(c.max.x-m.max.x)-(Math.min(m.min.x,l.x)-m.min.x)/(c.min.x-m.min.x),(Math.max(m.max.y,l.y)-m.max.y)/(c.max.y-m.max.y)-(Math.min(m.min.y,l.y)-m.min.y)/(c.min.y-m.min.y)).multiplyBy(n);i.panBy(g,{animate:!1}),this._draggable._newPos._add(g),this._draggable._startPos._add(g),G(e._icon,this._draggable._newPos),this._onDrag(t),this._panRequest=tt(this._adjustPan.bind(this,t))}},_onDragStart:function(){this._oldLatLng=this._marker.getLatLng(),this._marker.closePopup&&this._marker.closePopup(),this._marker.fire("movestart").fire("dragstart")},_onPreDrag:function(t){this._marker.options.autoPan&&(at(this._panRequest),this._panRequest=tt(this._adjustPan.bind(this,t)))},_onDrag:function(t){var e=this._marker,i=e._shadow,n=Et(e._icon),o=e._map.layerPointToLatLng(n);i&&G(i,n),e._latlng=o,t.latlng=o,t.oldLatLng=this._oldLatLng,e.fire("move",t).fire("drag",t)},_onDragEnd:function(t){at(this._panRequest),delete this._oldLatLng,this._marker.fire("moveend").fire("dragend",t)}}),Fe=dt.extend({options:{icon:new fe,interactive:!0,keyboard:!0,title:"",alt:"Marker",zIndexOffset:0,opacity:1,riseOnHover:!1,riseOffset:250,pane:"markerPane",shadowPane:"shadowPane",bubblingMouseEvents:!1,autoPanOnFocus:!0,draggable:!1,autoPan:!1,autoPanPadding:[50,50],autoPanSpeed:10},initialize:function(t,e){O(this,e),this._latlng=I(t)},onAdd:function(t){this._zoomAnimated=this._zoomAnimated&&t.options.markerZoomAnimation,this._zoomAnimated&&t.on("zoomanim",this._animateZoom,this),this._initIcon(),this.update()},onRemove:function(t){this.dragging&&this.dragging.enabled()&&(this.options.draggable=!0,this.dragging.removeHooks()),delete this.dragging,this._zoomAnimated&&t.off("zoomanim",this._animateZoom,this),this._removeIcon(),this._removeShadow()},getEvents:function(){return{zoom:this.update,viewreset:this.update}},getLatLng:function(){return this._latlng},setLatLng:function(t){var e=this._latlng;return this._latlng=I(t),this.update(),this.fire("move",{oldLatLng:e,latlng:this._latlng})},setZIndexOffset:function(t){return this.options.zIndexOffset=t,this.update()},getIcon:function(){return this.options.icon},setIcon:function(t){return this.options.icon=t,this._map&&(this._initIcon(),this.update()),this._popup&&this.bindPopup(this._popup,this._popup.options),this},getElement:function(){return this._icon},update:function(){if(this._icon&&this._map){var t=this._map.latLngToLayerPoint(this._latlng).round();this._setPos(t)}return this},_initIcon:function(){var t=this.options,e="leaflet-zoom-"+(this._zoomAnimated?"animated":"hide"),i=t.icon.createIcon(this._icon),n=!1;i!==this._icon&&(this._icon&&this._removeIcon(),n=!0,t.title&&(i.title=t.title),i.tagName==="IMG"&&(i.alt=t.alt||"")),A(i,e),t.keyboard&&(i.tabIndex="0",i.setAttribute("role","button")),this._icon=i,t.riseOnHover&&this.on({mouseover:this._bringToFront,mouseout:this._resetZIndex}),this.options.autoPanOnFocus&&C(i,"focus",this._panOnFocus,this);var o=t.icon.createShadow(this._shadow),l=!1;o!==this._shadow&&(this._removeShadow(),l=!0),o&&(A(o,e),o.alt=""),this._shadow=o,t.opacity<1&&this._updateOpacity(),n&&this.getPane().appendChild(this._icon),this._initInteraction(),o&&l&&this.getPane(t.shadowPane).appendChild(this._shadow)},_removeIcon:function(){this.options.riseOnHover&&this.off({mouseover:this._bringToFront,mouseout:this._resetZIndex}),this.options.autoPanOnFocus&&D(this._icon,"focus",this._panOnFocus,this),H(this._icon),this.removeInteractiveTarget(this._icon),this._icon=null},_removeShadow:function(){this._shadow&&H(this._shadow),this._shadow=null},_setPos:function(t){this._icon&&G(this._icon,t),this._shadow&&G(this._shadow,t),this._zIndex=t.y+this.options.zIndexOffset,this._resetZIndex()},_updateZIndex:function(t){this._icon&&(this._icon.style.zIndex=this._zIndex+t)},_animateZoom:function(t){var e=this._map._latLngToNewLayerPoint(this._latlng,t.zoom,t.center).round();this._setPos(e)},_initInteraction:function(){if(this.options.interactive&&(A(this._icon,"leaflet-interactive"),this.addInteractiveTarget(this._icon),Hn)){var t=this.options.draggable;this.dragging&&(t=this.dragging.enabled(),this.dragging.disable()),this.dragging=new Hn(this),t&&this.dragging.enable()}},setOpacity:function(t){return this.options.opacity=t,this._map&&this._updateOpacity(),this},_updateOpacity:function(){var t=this.options.opacity;this._icon&&lt(this._icon,t),this._shadow&&lt(this._shadow,t)},_bringToFront:function(){this._updateZIndex(this.options.riseOffset)},_resetZIndex:function(){this._updateZIndex(0)},_panOnFocus:function(){var t=this._map;if(t){var e=this.options.icon.options,i=e.iconSize?T(e.iconSize):T(0,0),n=e.iconAnchor?T(e.iconAnchor):T(0,0);t.panInside(this._latlng,{paddingTopLeft:n,paddingBottomRight:i.subtract(n)})}},_getPopupAnchor:function(){return this.options.icon.options.popupAnchor},_getTooltipAnchor:function(){return this.options.icon.options.tooltipAnchor}});function as(t,e){return new Fe(t,e)}var Mt=dt.extend({options:{stroke:!0,color:"#3388ff",weight:3,opacity:1,lineCap:"round",lineJoin:"round",dashArray:null,dashOffset:null,fill:!1,fillColor:null,fillOpacity:.2,fillRule:"evenodd",interactive:!0,bubblingMouseEvents:!0},beforeAdd:function(t){this._renderer=t.getRenderer(this)},onAdd:function(){this._renderer._initPath(this),this._reset(),this._renderer._addPath(this)},onRemove:function(){this._renderer._removePath(this)},redraw:function(){return this._map&&this._renderer._updatePath(this),this},setStyle:function(t){return O(this,t),this._renderer&&(this._renderer._updateStyle(this),this.options.stroke&&t&&Object.prototype.hasOwnProperty.call(t,"weight")&&this._updateBounds()),this},bringToFront:function(){return this._renderer&&this._renderer._bringToFront(this),this},bringToBack:function(){return this._renderer&&this._renderer._bringToBack(this),this},getElement:function(){return this._path},_reset:function(){this._project(),this._update()},_clickTolerance:function(){return(this.options.stroke?this.options.weight/2:0)+(this._renderer.options.tolerance||0)}}),He=Mt.extend({options:{fill:!0,radius:10},initialize:function(t,e){O(this,e),this._latlng=I(t),this._radius=this.options.radius},setLatLng:function(t){var e=this._latlng;return this._latlng=I(t),this.redraw(),this.fire("move",{oldLatLng:e,latlng:this._latlng})},getLatLng:function(){return this._latlng},setRadius:function(t){return this.options.radius=this._radius=t,this.redraw()},getRadius:function(){return this._radius},setStyle:function(t){var e=t&&t.radius||this._radius;return Mt.prototype.setStyle.call(this,t),this.setRadius(e),this},_project:function(){this._point=this._map.latLngToLayerPoint(this._latlng),this._updateBounds()},_updateBounds:function(){var t=this._radius,e=this._radiusY||t,i=this._clickTolerance(),n=[t+i,e+i];this._pxBounds=new F(this._point.subtract(n),this._point.add(n))},_update:function(){this._map&&this._updatePath()},_updatePath:function(){this._renderer._updateCircle(this)},_empty:function(){return this._radius&&!this._renderer._bounds.intersects(this._pxBounds)},_containsPoint:function(t){return t.distanceTo(this._point)<=this._radius+this._clickTolerance()}});function ls(t,e){return new He(t,e)}var zi=He.extend({initialize:function(t,e,i){if(typeof e=="number"&&(e=u({},i,{radius:e})),O(this,e),this._latlng=I(t),isNaN(this.options.radius))throw new Error("Circle radius cannot be NaN");this._mRadius=this.options.radius},setRadius:function(t){return this._mRadius=t,this.redraw()},getRadius:function(){return this._mRadius},getBounds:function(){var t=[this._radius,this._radiusY||this._radius];return new nt(this._map.layerPointToLatLng(this._point.subtract(t)),this._map.layerPointToLatLng(this._point.add(t)))},setStyle:Mt.prototype.setStyle,_project:function(){var t=this._latlng.lng,e=this._latlng.lat,i=this._map,n=i.options.crs;if(n.distance===Tt.distance){var o=Math.PI/180,l=this._mRadius/Tt.R/o,c=i.project([e+l,t]),d=i.project([e-l,t]),m=c.add(d).divideBy(2),g=i.unproject(m).lat,w=Math.acos((Math.cos(l*o)-Math.sin(e*o)*Math.sin(g*o))/(Math.cos(e*o)*Math.cos(g*o)))/o;(isNaN(w)||w===0)&&(w=l/Math.cos(Math.PI/180*e)),this._point=m.subtract(i.getPixelOrigin()),this._radius=isNaN(w)?0:m.x-i.project([g,t-w]).x,this._radiusY=m.y-c.y}else{var P=n.unproject(n.project(this._latlng).subtract([this._mRadius,0]));this._point=i.latLngToLayerPoint(this._latlng),this._radius=this._point.x-i.latLngToLayerPoint(P).x}this._updateBounds()}});function hs(t,e,i){return new zi(t,e,i)}var xt=Mt.extend({options:{smoothFactor:1,noClip:!1},initialize:function(t,e){O(this,e),this._setLatLngs(t)},getLatLngs:function(){return this._latlngs},setLatLngs:function(t){return this._setLatLngs(t),this.redraw()},isEmpty:function(){return!this._latlngs.length},closestLayerPoint:function(t){for(var e=1/0,i=null,n=pe,o,l,c=0,d=this._parts.length;c<d;c++)for(var m=this._parts[c],g=1,w=m.length;g<w;g++){o=m[g-1],l=m[g];var P=n(t,o,l,!0);P<e&&(e=P,i=n(t,o,l))}return i&&(i.distance=Math.sqrt(e)),i},getCenter:function(){if(!this._map)throw new Error("Must add layer to map before using getCenter()");return Dn(this._defaultShape(),this._map.options.crs)},getBounds:function(){return this._bounds},addLatLng:function(t,e){return e=e||this._defaultShape(),t=I(t),e.push(t),this._bounds.extend(t),this.redraw()},_setLatLngs:function(t){this._bounds=new nt,this._latlngs=this._convertLatLngs(t)},_defaultShape:function(){return ht(this._latlngs)?this._latlngs:this._latlngs[0]},_convertLatLngs:function(t){for(var e=[],i=ht(t),n=0,o=t.length;n<o;n++)i?(e[n]=I(t[n]),this._bounds.extend(e[n])):e[n]=this._convertLatLngs(t[n]);return e},_project:function(){var t=new F;this._rings=[],this._projectLatlngs(this._latlngs,this._rings,t),this._bounds.isValid()&&t.isValid()&&(this._rawPxBounds=t,this._updateBounds())},_updateBounds:function(){var t=this._clickTolerance(),e=new M(t,t);this._rawPxBounds&&(this._pxBounds=new F([this._rawPxBounds.min.subtract(e),this._rawPxBounds.max.add(e)]))},_projectLatlngs:function(t,e,i){var n=t[0]instanceof N,o=t.length,l,c;if(n){for(c=[],l=0;l<o;l++)c[l]=this._map.latLngToLayerPoint(t[l]),i.extend(c[l]);e.push(c)}else for(l=0;l<o;l++)this._projectLatlngs(t[l],e,i)},_clipPoints:function(){var t=this._renderer._bounds;if(this._parts=[],!(!this._pxBounds||!this._pxBounds.intersects(t))){if(this.options.noClip){this._parts=this._rings;return}var e=this._parts,i,n,o,l,c,d,m;for(i=0,o=0,l=this._rings.length;i<l;i++)for(m=this._rings[i],n=0,c=m.length;n<c-1;n++)d=Rn(m[n],m[n+1],t,n,!0),d&&(e[o]=e[o]||[],e[o].push(d[0]),(d[1]!==m[n+1]||n===c-2)&&(e[o].push(d[1]),o++))}},_simplifyPoints:function(){for(var t=this._parts,e=this.options.smoothFactor,i=0,n=t.length;i<n;i++)t[i]=In(t[i],e)},_update:function(){this._map&&(this._clipPoints(),this._simplifyPoints(),this._updatePath())},_updatePath:function(){this._renderer._updatePoly(this)},_containsPoint:function(t,e){var i,n,o,l,c,d,m=this._clickTolerance();if(!this._pxBounds||!this._pxBounds.contains(t))return!1;for(i=0,l=this._parts.length;i<l;i++)for(d=this._parts[i],n=0,c=d.length,o=c-1;n<c;o=n++)if(!(!e&&n===0)&&Bn(t,d[o],d[n])<=m)return!0;return!1}});function us(t,e){return new xt(t,e)}xt._flat=Nn;var Vt=xt.extend({options:{fill:!0},isEmpty:function(){return!this._latlngs.length||!this._latlngs[0].length},getCenter:function(){if(!this._map)throw new Error("Must add layer to map before using getCenter()");return $n(this._defaultShape(),this._map.options.crs)},_convertLatLngs:function(t){var e=xt.prototype._convertLatLngs.call(this,t),i=e.length;return i>=2&&e[0]instanceof N&&e[0].equals(e[i-1])&&e.pop(),e},_setLatLngs:function(t){xt.prototype._setLatLngs.call(this,t),ht(this._latlngs)&&(this._latlngs=[this._latlngs])},_defaultShape:function(){return ht(this._latlngs[0])?this._latlngs[0]:this._latlngs[0][0]},_clipPoints:function(){var t=this._renderer._bounds,e=this.options.weight,i=new M(e,e);if(t=new F(t.min.subtract(i),t.max.add(i)),this._parts=[],!(!this._pxBounds||!this._pxBounds.intersects(t))){if(this.options.noClip){this._parts=this._rings;return}for(var n=0,o=this._rings.length,l;n<o;n++)l=On(this._rings[n],t,!0),l.length&&this._parts.push(l)}},_updatePath:function(){this._renderer._updatePoly(this,!0)},_containsPoint:function(t){var e=!1,i,n,o,l,c,d,m,g;if(!this._pxBounds||!this._pxBounds.contains(t))return!1;for(l=0,m=this._parts.length;l<m;l++)for(i=this._parts[l],c=0,g=i.length,d=g-1;c<g;d=c++)n=i[c],o=i[d],n.y>t.y!=o.y>t.y&&t.x<(o.x-n.x)*(t.y-n.y)/(o.y-n.y)+n.x&&(e=!e);return e||xt.prototype._containsPoint.call(this,t,!0)}});function cs(t,e){return new Vt(t,e)}var kt=bt.extend({initialize:function(t,e){O(this,e),this._layers={},t&&this.addData(t)},addData:function(t){var e=rt(t)?t:t.features,i,n,o;if(e){for(i=0,n=e.length;i<n;i++)o=e[i],(o.geometries||o.geometry||o.features||o.coordinates)&&this.addData(o);return this}var l=this.options;if(l.filter&&!l.filter(t))return this;var c=Ue(t,l);return c?(c.feature=je(t),c.defaultOptions=c.options,this.resetStyle(c),l.onEachFeature&&l.onEachFeature(t,c),this.addLayer(c)):this},resetStyle:function(t){return t===void 0?this.eachLayer(this.resetStyle,this):(t.options=u({},t.defaultOptions),this._setLayerStyle(t,this.options.style),this)},setStyle:function(t){return this.eachLayer(function(e){this._setLayerStyle(e,t)},this)},_setLayerStyle:function(t,e){t.setStyle&&(typeof e=="function"&&(e=e(t.feature)),t.setStyle(e))}});function Ue(t,e){var i=t.type==="Feature"?t.geometry:t,n=i?i.coordinates:null,o=[],l=e&&e.pointToLayer,c=e&&e.coordsToLatLng||Ei,d,m,g,w;if(!n&&!i)return null;switch(i.type){case"Point":return d=c(n),Un(l,t,d,e);case"MultiPoint":for(g=0,w=n.length;g<w;g++)d=c(n[g]),o.push(Un(l,t,d,e));return new bt(o);case"LineString":case"MultiLineString":return m=We(n,i.type==="LineString"?0:1,c),new xt(m,e);case"Polygon":case"MultiPolygon":return m=We(n,i.type==="Polygon"?1:2,c),new Vt(m,e);case"GeometryCollection":for(g=0,w=i.geometries.length;g<w;g++){var P=Ue({geometry:i.geometries[g],type:"Feature",properties:t.properties},e);P&&o.push(P)}return new bt(o);case"FeatureCollection":for(g=0,w=i.features.length;g<w;g++){var z=Ue(i.features[g],e);z&&o.push(z)}return new bt(o);default:throw new Error("Invalid GeoJSON object.")}}function Un(t,e,i,n){return t?t(e,i):new Fe(i,n&&n.markersInheritOptions&&n)}function Ei(t){return new N(t[1],t[0],t[2])}function We(t,e,i){for(var n=[],o=0,l=t.length,c;o<l;o++)c=e?We(t[o],e-1,i):(i||Ei)(t[o]),n.push(c);return n}function Oi(t,e){return t=I(t),t.alt!==void 0?[S(t.lng,e),S(t.lat,e),S(t.alt,e)]:[S(t.lng,e),S(t.lat,e)]}function qe(t,e,i,n){for(var o=[],l=0,c=t.length;l<c;l++)o.push(e?qe(t[l],ht(t[l])?0:e-1,i,n):Oi(t[l],n));return!e&&i&&o.length>0&&o.push(o[0].slice()),o}function Kt(t,e){return t.feature?u({},t.feature,{geometry:e}):je(e)}function je(t){return t.type==="Feature"||t.type==="FeatureCollection"?t:{type:"Feature",properties:{},geometry:t}}var $i={toGeoJSON:function(t){return Kt(this,{type:"Point",coordinates:Oi(this.getLatLng(),t)})}};Fe.include($i),zi.include($i),He.include($i),xt.include({toGeoJSON:function(t){var e=!ht(this._latlngs),i=qe(this._latlngs,e?1:0,!1,t);return Kt(this,{type:(e?"Multi":"")+"LineString",coordinates:i})}}),Vt.include({toGeoJSON:function(t){var e=!ht(this._latlngs),i=e&&!ht(this._latlngs[0]),n=qe(this._latlngs,i?2:e?1:0,!0,t);return e||(n=[n]),Kt(this,{type:(i?"Multi":"")+"Polygon",coordinates:n})}}),jt.include({toMultiPoint:function(t){var e=[];return this.eachLayer(function(i){e.push(i.toGeoJSON(t).geometry.coordinates)}),Kt(this,{type:"MultiPoint",coordinates:e})},toGeoJSON:function(t){var e=this.feature&&this.feature.geometry&&this.feature.geometry.type;if(e==="MultiPoint")return this.toMultiPoint(t);var i=e==="GeometryCollection",n=[];return this.eachLayer(function(o){if(o.toGeoJSON){var l=o.toGeoJSON(t);if(i)n.push(l.geometry);else{var c=je(l);c.type==="FeatureCollection"?n.push.apply(n,c.features):n.push(c)}}}),i?Kt(this,{geometries:n,type:"GeometryCollection"}):{type:"FeatureCollection",features:n}}});function Wn(t,e){return new kt(t,e)}var ds=Wn,Ge=dt.extend({options:{opacity:1,alt:"",interactive:!1,crossOrigin:!1,errorOverlayUrl:"",zIndex:1,className:""},initialize:function(t,e,i){this._url=t,this._bounds=j(e),O(this,i)},onAdd:function(){this._image||(this._initImage(),this.options.opacity<1&&this._updateOpacity()),this.options.interactive&&(A(this._image,"leaflet-interactive"),this.addInteractiveTarget(this._image)),this.getPane().appendChild(this._image),this._reset()},onRemove:function(){H(this._image),this.options.interactive&&this.removeInteractiveTarget(this._image)},setOpacity:function(t){return this.options.opacity=t,this._image&&this._updateOpacity(),this},setStyle:function(t){return t.opacity&&this.setOpacity(t.opacity),this},bringToFront:function(){return this._map&&Wt(this._image),this},bringToBack:function(){return this._map&&qt(this._image),this},setUrl:function(t){return this._url=t,this._image&&(this._image.src=t),this},setBounds:function(t){return this._bounds=j(t),this._map&&this._reset(),this},getEvents:function(){var t={zoom:this._reset,viewreset:this._reset};return this._zoomAnimated&&(t.zoomanim=this._animateZoom),t},setZIndex:function(t){return this.options.zIndex=t,this._updateZIndex(),this},getBounds:function(){return this._bounds},getElement:function(){return this._image},_initImage:function(){var t=this._url.tagName==="IMG",e=this._image=t?this._url:Z("img");if(A(e,"leaflet-image-layer"),this._zoomAnimated&&A(e,"leaflet-zoom-animated"),this.options.className&&A(e,this.options.className),e.onselectstart=y,e.onmousemove=y,e.onload=f(this.fire,this,"load"),e.onerror=f(this._overlayOnError,this,"error"),(this.options.crossOrigin||this.options.crossOrigin==="")&&(e.crossOrigin=this.options.crossOrigin===!0?"":this.options.crossOrigin),this.options.zIndex&&this._updateZIndex(),t){this._url=e.src;return}e.src=this._url,e.alt=this.options.alt},_animateZoom:function(t){var e=this._map.getZoomScale(t.zoom),i=this._map._latLngBoundsToNewLayerBounds(this._bounds,t.zoom,t.center).min;zt(this._image,i,e)},_reset:function(){var t=this._image,e=new F(this._map.latLngToLayerPoint(this._bounds.getNorthWest()),this._map.latLngToLayerPoint(this._bounds.getSouthEast())),i=e.getSize();G(t,e.min),t.style.width=i.x+"px",t.style.height=i.y+"px"},_updateOpacity:function(){lt(this._image,this.options.opacity)},_updateZIndex:function(){this._image&&this.options.zIndex!==void 0&&this.options.zIndex!==null&&(this._image.style.zIndex=this.options.zIndex)},_overlayOnError:function(){this.fire("error");var t=this.options.errorOverlayUrl;t&&this._url!==t&&(this._url=t,this._image.src=t)},getCenter:function(){return this._bounds.getCenter()}}),ps=function(t,e,i){return new Ge(t,e,i)},qn=Ge.extend({options:{autoplay:!0,loop:!0,keepAspectRatio:!0,muted:!1,playsInline:!0},_initImage:function(){var t=this._url.tagName==="VIDEO",e=this._image=t?this._url:Z("video");if(A(e,"leaflet-image-layer"),this._zoomAnimated&&A(e,"leaflet-zoom-animated"),this.options.className&&A(e,this.options.className),e.onselectstart=y,e.onmousemove=y,e.onloadeddata=f(this.fire,this,"load"),t){for(var i=e.getElementsByTagName("source"),n=[],o=0;o<i.length;o++)n.push(i[o].src);this._url=i.length>0?n:[e.src];return}rt(this._url)||(this._url=[this._url]),!this.options.keepAspectRatio&&Object.prototype.hasOwnProperty.call(e.style,"objectFit")&&(e.style.objectFit="fill"),e.autoplay=!!this.options.autoplay,e.loop=!!this.options.loop,e.muted=!!this.options.muted,e.playsInline=!!this.options.playsInline;for(var l=0;l<this._url.length;l++){var c=Z("source");c.src=this._url[l],e.appendChild(c)}}});function fs(t,e,i){return new qn(t,e,i)}var jn=Ge.extend({_initImage:function(){var t=this._image=this._url;A(t,"leaflet-image-layer"),this._zoomAnimated&&A(t,"leaflet-zoom-animated"),this.options.className&&A(t,this.options.className),t.onselectstart=y,t.onmousemove=y}});function ms(t,e,i){return new jn(t,e,i)}var gt=dt.extend({options:{interactive:!1,offset:[0,0],className:"",pane:void 0,content:""},initialize:function(t,e){t&&(t instanceof N||rt(t))?(this._latlng=I(t),O(this,e)):(O(this,t),this._source=e),this.options.content&&(this._content=this.options.content)},openOn:function(t){return t=arguments.length?t:this._source._map,t.hasLayer(this)||t.addLayer(this),this},close:function(){return this._map&&this._map.removeLayer(this),this},toggle:function(t){return this._map?this.close():(arguments.length?this._source=t:t=this._source,this._prepareOpen(),this.openOn(t._map)),this},onAdd:function(t){this._zoomAnimated=t._zoomAnimated,this._container||this._initLayout(),t._fadeAnimated&&lt(this._container,0),clearTimeout(this._removeTimeout),this.getPane().appendChild(this._container),this.update(),t._fadeAnimated&&lt(this._container,1),this.bringToFront(),this.options.interactive&&(A(this._container,"leaflet-interactive"),this.addInteractiveTarget(this._container))},onRemove:function(t){t._fadeAnimated?(lt(this._container,0),this._removeTimeout=setTimeout(f(H,void 0,this._container),200)):H(this._container),this.options.interactive&&(q(this._container,"leaflet-interactive"),this.removeInteractiveTarget(this._container))},getLatLng:function(){return this._latlng},setLatLng:function(t){return this._latlng=I(t),this._map&&(this._updatePosition(),this._adjustPan()),this},getContent:function(){return this._content},setContent:function(t){return this._content=t,this.update(),this},getElement:function(){return this._container},update:function(){this._map&&(this._container.style.visibility="hidden",this._updateContent(),this._updateLayout(),this._updatePosition(),this._container.style.visibility="",this._adjustPan())},getEvents:function(){var t={zoom:this._updatePosition,viewreset:this._updatePosition};return this._zoomAnimated&&(t.zoomanim=this._animateZoom),t},isOpen:function(){return!!this._map&&this._map.hasLayer(this)},bringToFront:function(){return this._map&&Wt(this._container),this},bringToBack:function(){return this._map&&qt(this._container),this},_prepareOpen:function(t){var e=this._source;if(!e._map)return!1;if(e instanceof bt){e=null;var i=this._source._layers;for(var n in i)if(i[n]._map){e=i[n];break}if(!e)return!1;this._source=e}if(!t)if(e.getCenter)t=e.getCenter();else if(e.getLatLng)t=e.getLatLng();else if(e.getBounds)t=e.getBounds().getCenter();else throw new Error("Unable to get source layer LatLng.");return this.setLatLng(t),this._map&&this.update(),!0},_updateContent:function(){if(this._content){var t=this._contentNode,e=typeof this._content=="function"?this._content(this._source||this):this._content;if(typeof e=="string")t.innerHTML=e;else{for(;t.hasChildNodes();)t.removeChild(t.firstChild);t.appendChild(e)}this.fire("contentupdate")}},_updatePosition:function(){if(this._map){var t=this._map.latLngToLayerPoint(this._latlng),e=T(this.options.offset),i=this._getAnchor();this._zoomAnimated?G(this._container,t.add(i)):e=e.add(t).add(i);var n=this._containerBottom=-e.y,o=this._containerLeft=-Math.round(this._containerWidth/2)+e.x;this._container.style.bottom=n+"px",this._container.style.left=o+"px"}},_getAnchor:function(){return[0,0]}});B.include({_initOverlay:function(t,e,i,n){var o=e;return o instanceof t||(o=new t(n).setContent(e)),i&&o.setLatLng(i),o}}),dt.include({_initOverlay:function(t,e,i,n){var o=i;return o instanceof t?(O(o,n),o._source=this):(o=e&&!n?e:new t(n,this),o.setContent(i)),o}});var Ve=gt.extend({options:{pane:"popupPane",offset:[0,7],maxWidth:300,minWidth:50,maxHeight:null,autoPan:!0,autoPanPaddingTopLeft:null,autoPanPaddingBottomRight:null,autoPanPadding:[5,5],keepInView:!1,closeButton:!0,autoClose:!0,closeOnEscapeKey:!0,className:""},openOn:function(t){return t=arguments.length?t:this._source._map,!t.hasLayer(this)&&t._popup&&t._popup.options.autoClose&&t.removeLayer(t._popup),t._popup=this,gt.prototype.openOn.call(this,t)},onAdd:function(t){gt.prototype.onAdd.call(this,t),t.fire("popupopen",{popup:this}),this._source&&(this._source.fire("popupopen",{popup:this},!0),this._source instanceof Mt||this._source.on("preclick",Ot))},onRemove:function(t){gt.prototype.onRemove.call(this,t),t.fire("popupclose",{popup:this}),this._source&&(this._source.fire("popupclose",{popup:this},!0),this._source instanceof Mt||this._source.off("preclick",Ot))},getEvents:function(){var t=gt.prototype.getEvents.call(this);return(this.options.closeOnClick!==void 0?this.options.closeOnClick:this._map.options.closePopupOnClick)&&(t.preclick=this.close),this.options.keepInView&&(t.moveend=this._adjustPan),t},_initLayout:function(){var t="leaflet-popup",e=this._container=Z("div",t+" "+(this.options.className||"")+" leaflet-zoom-animated"),i=this._wrapper=Z("div",t+"-content-wrapper",e);if(this._contentNode=Z("div",t+"-content",i),ce(e),ki(this._contentNode),C(e,"contextmenu",Ot),this._tipContainer=Z("div",t+"-tip-container",e),this._tip=Z("div",t+"-tip",this._tipContainer),this.options.closeButton){var n=this._closeButton=Z("a",t+"-close-button",e);n.setAttribute("role","button"),n.setAttribute("aria-label","Close popup"),n.href="#close",n.innerHTML='<span aria-hidden="true">&#215;</span>',C(n,"click",function(o){X(o),this.close()},this)}},_updateLayout:function(){var t=this._contentNode,e=t.style;e.width="",e.whiteSpace="nowrap";var i=t.offsetWidth;i=Math.min(i,this.options.maxWidth),i=Math.max(i,this.options.minWidth),e.width=i+1+"px",e.whiteSpace="",e.height="";var n=t.offsetHeight,o=this.options.maxHeight,l="leaflet-popup-scrolled";o&&n>o?(e.height=o+"px",A(t,l)):q(t,l),this._containerWidth=this._container.offsetWidth},_animateZoom:function(t){var e=this._map._latLngToNewLayerPoint(this._latlng,t.zoom,t.center),i=this._getAnchor();G(this._container,e.add(i))},_adjustPan:function(){if(this.options.autoPan){if(this._map._panAnim&&this._map._panAnim.stop(),this._autopanning){this._autopanning=!1;return}var t=this._map,e=parseInt(ae(this._container,"marginBottom"),10)||0,i=this._container.offsetHeight+e,n=this._containerWidth,o=new M(this._containerLeft,-i-this._containerBottom);o._add(Et(this._container));var l=t.layerPointToContainerPoint(o),c=T(this.options.autoPanPadding),d=T(this.options.autoPanPaddingTopLeft||c),m=T(this.options.autoPanPaddingBottomRight||c),g=t.getSize(),w=0,P=0;l.x+n+m.x>g.x&&(w=l.x+n-g.x+m.x),l.x-w-d.x<0&&(w=l.x-d.x),l.y+i+m.y>g.y&&(P=l.y+i-g.y+m.y),l.y-P-d.y<0&&(P=l.y-d.y),(w||P)&&(this.options.keepInView&&(this._autopanning=!0),t.fire("autopanstart").panBy([w,P]))}},_getAnchor:function(){return T(this._source&&this._source._getPopupAnchor?this._source._getPopupAnchor():[0,0])}}),_s=function(t,e){return new Ve(t,e)};B.mergeOptions({closePopupOnClick:!0}),B.include({openPopup:function(t,e,i){return this._initOverlay(Ve,t,e,i).openOn(this),this},closePopup:function(t){return t=arguments.length?t:this._popup,t&&t.close(),this}}),dt.include({bindPopup:function(t,e){return this._popup=this._initOverlay(Ve,this._popup,t,e),this._popupHandlersAdded||(this.on({click:this._openPopup,keypress:this._onKeyPress,remove:this.closePopup,move:this._movePopup}),this._popupHandlersAdded=!0),this},unbindPopup:function(){return this._popup&&(this.off({click:this._openPopup,keypress:this._onKeyPress,remove:this.closePopup,move:this._movePopup}),this._popupHandlersAdded=!1,this._popup=null),this},openPopup:function(t){return this._popup&&(this instanceof bt||(this._popup._source=this),this._popup._prepareOpen(t||this._latlng)&&this._popup.openOn(this._map)),this},closePopup:function(){return this._popup&&this._popup.close(),this},togglePopup:function(){return this._popup&&this._popup.toggle(this),this},isPopupOpen:function(){return this._popup?this._popup.isOpen():!1},setPopupContent:function(t){return this._popup&&this._popup.setContent(t),this},getPopup:function(){return this._popup},_openPopup:function(t){if(!(!this._popup||!this._map)){$t(t);var e=t.layer||t.target;if(this._popup._source===e&&!(e instanceof Mt)){this._map.hasLayer(this._popup)?this.closePopup():this.openPopup(t.latlng);return}this._popup._source=e,this.openPopup(t.latlng)}},_movePopup:function(t){this._popup.setLatLng(t.latlng)},_onKeyPress:function(t){t.originalEvent.keyCode===13&&this._openPopup(t)}});var Ke=gt.extend({options:{pane:"tooltipPane",offset:[0,0],direction:"auto",permanent:!1,sticky:!1,opacity:.9},onAdd:function(t){gt.prototype.onAdd.call(this,t),this.setOpacity(this.options.opacity),t.fire("tooltipopen",{tooltip:this}),this._source&&(this.addEventParent(this._source),this._source.fire("tooltipopen",{tooltip:this},!0))},onRemove:function(t){gt.prototype.onRemove.call(this,t),t.fire("tooltipclose",{tooltip:this}),this._source&&(this.removeEventParent(this._source),this._source.fire("tooltipclose",{tooltip:this},!0))},getEvents:function(){var t=gt.prototype.getEvents.call(this);return this.options.permanent||(t.preclick=this.close),t},_initLayout:function(){var t="leaflet-tooltip",e=t+" "+(this.options.className||"")+" leaflet-zoom-"+(this._zoomAnimated?"animated":"hide");this._contentNode=this._container=Z("div",e),this._container.setAttribute("role","tooltip"),this._container.setAttribute("id","leaflet-tooltip-"+_(this))},_updateLayout:function(){},_adjustPan:function(){},_setPosition:function(t){var e,i,n=this._map,o=this._container,l=n.latLngToContainerPoint(n.getCenter()),c=n.layerPointToContainerPoint(t),d=this.options.direction,m=o.offsetWidth,g=o.offsetHeight,w=T(this.options.offset),P=this._getAnchor();d==="top"?(e=m/2,i=g):d==="bottom"?(e=m/2,i=0):d==="center"?(e=m/2,i=g/2):d==="right"?(e=0,i=g/2):d==="left"?(e=m,i=g/2):c.x<l.x?(d="right",e=0,i=g/2):(d="left",e=m+(w.x+P.x)*2,i=g/2),t=t.subtract(T(e,i,!0)).add(w).add(P),q(o,"leaflet-tooltip-right"),q(o,"leaflet-tooltip-left"),q(o,"leaflet-tooltip-top"),q(o,"leaflet-tooltip-bottom"),A(o,"leaflet-tooltip-"+d),G(o,t)},_updatePosition:function(){var t=this._map.latLngToLayerPoint(this._latlng);this._setPosition(t)},setOpacity:function(t){this.options.opacity=t,this._container&&lt(this._container,t)},_animateZoom:function(t){var e=this._map._latLngToNewLayerPoint(this._latlng,t.zoom,t.center);this._setPosition(e)},_getAnchor:function(){return T(this._source&&this._source._getTooltipAnchor&&!this.options.sticky?this._source._getTooltipAnchor():[0,0])}}),gs=function(t,e){return new Ke(t,e)};B.include({openTooltip:function(t,e,i){return this._initOverlay(Ke,t,e,i).openOn(this),this},closeTooltip:function(t){return t.close(),this}}),dt.include({bindTooltip:function(t,e){return this._tooltip&&this.isTooltipOpen()&&this.unbindTooltip(),this._tooltip=this._initOverlay(Ke,this._tooltip,t,e),this._initTooltipInteractions(),this._tooltip.options.permanent&&this._map&&this._map.hasLayer(this)&&this.openTooltip(),this},unbindTooltip:function(){return this._tooltip&&(this._initTooltipInteractions(!0),this.closeTooltip(),this._tooltip=null),this},_initTooltipInteractions:function(t){if(!(!t&&this._tooltipHandlersAdded)){var e=t?"off":"on",i={remove:this.closeTooltip,move:this._moveTooltip};this._tooltip.options.permanent?i.add=this._openTooltip:(i.mouseover=this._openTooltip,i.mouseout=this.closeTooltip,i.click=this._openTooltip,this._map?this._addFocusListeners():i.add=this._addFocusListeners),this._tooltip.options.sticky&&(i.mousemove=this._moveTooltip),this[e](i),this._tooltipHandlersAdded=!t}},openTooltip:function(t){return this._tooltip&&(this instanceof bt||(this._tooltip._source=this),this._tooltip._prepareOpen(t)&&(this._tooltip.openOn(this._map),this.getElement?this._setAriaDescribedByOnLayer(this):this.eachLayer&&this.eachLayer(this._setAriaDescribedByOnLayer,this))),this},closeTooltip:function(){if(this._tooltip)return this._tooltip.close()},toggleTooltip:function(){return this._tooltip&&this._tooltip.toggle(this),this},isTooltipOpen:function(){return this._tooltip.isOpen()},setTooltipContent:function(t){return this._tooltip&&this._tooltip.setContent(t),this},getTooltip:function(){return this._tooltip},_addFocusListeners:function(){this.getElement?this._addFocusListenersOnLayer(this):this.eachLayer&&this.eachLayer(this._addFocusListenersOnLayer,this)},_addFocusListenersOnLayer:function(t){var e=typeof t.getElement=="function"&&t.getElement();e&&(C(e,"focus",function(){this._tooltip._source=t,this.openTooltip()},this),C(e,"blur",this.closeTooltip,this))},_setAriaDescribedByOnLayer:function(t){var e=typeof t.getElement=="function"&&t.getElement();e&&e.setAttribute("aria-describedby",this._tooltip._container.id)},_openTooltip:function(t){if(!(!this._tooltip||!this._map)){if(this._map.dragging&&this._map.dragging.moving()&&!this._openOnceFlag){this._openOnceFlag=!0;var e=this;this._map.once("moveend",function(){e._openOnceFlag=!1,e._openTooltip(t)});return}this._tooltip._source=t.layer||t.target,this.openTooltip(this._tooltip.options.sticky?t.latlng:void 0)}},_moveTooltip:function(t){var e=t.latlng,i,n;this._tooltip.options.sticky&&t.originalEvent&&(i=this._map.mouseEventToContainerPoint(t.originalEvent),n=this._map.containerPointToLayerPoint(i),e=this._map.layerPointToLatLng(n)),this._tooltip.setLatLng(e)}});var Gn=Gt.extend({options:{iconSize:[12,12],html:!1,bgPos:null,className:"leaflet-div-icon"},createIcon:function(t){var e=t&&t.tagName==="DIV"?t:document.createElement("div"),i=this.options;if(i.html instanceof Element?(Ie(e),e.appendChild(i.html)):e.innerHTML=i.html!==!1?i.html:"",i.bgPos){var n=T(i.bgPos);e.style.backgroundPosition=-n.x+"px "+-n.y+"px"}return this._setIconStyles(e,"icon"),e},createShadow:function(){return null}});function vs(t){return new Gn(t)}Gt.Default=fe;var me=dt.extend({options:{tileSize:256,opacity:1,updateWhenIdle:x.mobile,updateWhenZooming:!0,updateInterval:200,zIndex:1,bounds:null,minZoom:0,maxZoom:void 0,maxNativeZoom:void 0,minNativeZoom:void 0,noWrap:!1,pane:"tilePane",className:"",keepBuffer:2},initialize:function(t){O(this,t)},onAdd:function(){this._initContainer(),this._levels={},this._tiles={},this._resetView()},beforeAdd:function(t){t._addZoomLimit(this)},onRemove:function(t){this._removeAllTiles(),H(this._container),t._removeZoomLimit(this),this._container=null,this._tileZoom=void 0},bringToFront:function(){return this._map&&(Wt(this._container),this._setAutoZIndex(Math.max)),this},bringToBack:function(){return this._map&&(qt(this._container),this._setAutoZIndex(Math.min)),this},getContainer:function(){return this._container},setOpacity:function(t){return this.options.opacity=t,this._updateOpacity(),this},setZIndex:function(t){return this.options.zIndex=t,this._updateZIndex(),this},isLoading:function(){return this._loading},redraw:function(){if(this._map){this._removeAllTiles();var t=this._clampZoom(this._map.getZoom());t!==this._tileZoom&&(this._tileZoom=t,this._updateLevels()),this._update()}return this},getEvents:function(){var t={viewprereset:this._invalidateAll,viewreset:this._resetView,zoom:this._resetView,moveend:this._onMoveEnd};return this.options.updateWhenIdle||(this._onMove||(this._onMove=b(this._onMoveEnd,this.options.updateInterval,this)),t.move=this._onMove),this._zoomAnimated&&(t.zoomanim=this._animateZoom),t},createTile:function(){return document.createElement("div")},getTileSize:function(){var t=this.options.tileSize;return t instanceof M?t:new M(t,t)},_updateZIndex:function(){this._container&&this.options.zIndex!==void 0&&this.options.zIndex!==null&&(this._container.style.zIndex=this.options.zIndex)},_setAutoZIndex:function(t){for(var e=this.getPane().children,i=-t(-1/0,1/0),n=0,o=e.length,l;n<o;n++)l=e[n].style.zIndex,e[n]!==this._container&&l&&(i=t(i,+l));isFinite(i)&&(this.options.zIndex=i+t(-1,1),this._updateZIndex())},_updateOpacity:function(){if(this._map&&!x.ielt9){lt(this._container,this.options.opacity);var t=+new Date,e=!1,i=!1;for(var n in this._tiles){var o=this._tiles[n];if(!(!o.current||!o.loaded)){var l=Math.min(1,(t-o.loaded)/200);lt(o.el,l),l<1?e=!0:(o.active?i=!0:this._onOpaqueTile(o),o.active=!0)}}i&&!this._noPrune&&this._pruneTiles(),e&&(at(this._fadeFrame),this._fadeFrame=tt(this._updateOpacity,this))}},_onOpaqueTile:y,_initContainer:function(){this._container||(this._container=Z("div","leaflet-layer "+(this.options.className||"")),this._updateZIndex(),this.options.opacity<1&&this._updateOpacity(),this.getPane().appendChild(this._container))},_updateLevels:function(){var t=this._tileZoom,e=this.options.maxZoom;if(t!==void 0){for(var i in this._levels)i=Number(i),this._levels[i].el.children.length||i===t?(this._levels[i].el.style.zIndex=e-Math.abs(t-i),this._onUpdateLevel(i)):(H(this._levels[i].el),this._removeTilesAtZoom(i),this._onRemoveLevel(i),delete this._levels[i]);var n=this._levels[t],o=this._map;return n||(n=this._levels[t]={},n.el=Z("div","leaflet-tile-container leaflet-zoom-animated",this._container),n.el.style.zIndex=e,n.origin=o.project(o.unproject(o.getPixelOrigin()),t).round(),n.zoom=t,this._setZoomTransform(n,o.getCenter(),o.getZoom()),y(n.el.offsetWidth),this._onCreateLevel(n)),this._level=n,n}},_onUpdateLevel:y,_onRemoveLevel:y,_onCreateLevel:y,_pruneTiles:function(){if(this._map){var t,e,i=this._map.getZoom();if(i>this.options.maxZoom||i<this.options.minZoom){this._removeAllTiles();return}for(t in this._tiles)e=this._tiles[t],e.retain=e.current;for(t in this._tiles)if(e=this._tiles[t],e.current&&!e.active){var n=e.coords;this._retainParent(n.x,n.y,n.z,n.z-5)||this._retainChildren(n.x,n.y,n.z,n.z+2)}for(t in this._tiles)this._tiles[t].retain||this._removeTile(t)}},_removeTilesAtZoom:function(t){for(var e in this._tiles)this._tiles[e].coords.z===t&&this._removeTile(e)},_removeAllTiles:function(){for(var t in this._tiles)this._removeTile(t)},_invalidateAll:function(){for(var t in this._levels)H(this._levels[t].el),this._onRemoveLevel(Number(t)),delete this._levels[t];this._removeAllTiles(),this._tileZoom=void 0},_retainParent:function(t,e,i,n){var o=Math.floor(t/2),l=Math.floor(e/2),c=i-1,d=new M(+o,+l);d.z=+c;var m=this._tileCoordsToKey(d),g=this._tiles[m];return g&&g.active?(g.retain=!0,!0):(g&&g.loaded&&(g.retain=!0),c>n?this._retainParent(o,l,c,n):!1)},_retainChildren:function(t,e,i,n){for(var o=2*t;o<2*t+2;o++)for(var l=2*e;l<2*e+2;l++){var c=new M(o,l);c.z=i+1;var d=this._tileCoordsToKey(c),m=this._tiles[d];if(m&&m.active){m.retain=!0;continue}else m&&m.loaded&&(m.retain=!0);i+1<n&&this._retainChildren(o,l,i+1,n)}},_resetView:function(t){var e=t&&(t.pinch||t.flyTo);this._setView(this._map.getCenter(),this._map.getZoom(),e,e)},_animateZoom:function(t){this._setView(t.center,t.zoom,!0,t.noUpdate)},_clampZoom:function(t){var e=this.options;return e.minNativeZoom!==void 0&&t<e.minNativeZoom?e.minNativeZoom:e.maxNativeZoom!==void 0&&e.maxNativeZoom<t?e.maxNativeZoom:t},_setView:function(t,e,i,n){var o=Math.round(e);this.options.maxZoom!==void 0&&o>this.options.maxZoom||this.options.minZoom!==void 0&&o<this.options.minZoom?o=void 0:o=this._clampZoom(o);var l=this.options.updateWhenZooming&&o!==this._tileZoom;(!n||l)&&(this._tileZoom=o,this._abortLoading&&this._abortLoading(),this._updateLevels(),this._resetGrid(),o!==void 0&&this._update(t),i||this._pruneTiles(),this._noPrune=!!i),this._setZoomTransforms(t,e)},_setZoomTransforms:function(t,e){for(var i in this._levels)this._setZoomTransform(this._levels[i],t,e)},_setZoomTransform:function(t,e,i){var n=this._map.getZoomScale(i,t.zoom),o=t.origin.multiplyBy(n).subtract(this._map._getNewPixelOrigin(e,i)).round();x.any3d?zt(t.el,o,n):G(t.el,o)},_resetGrid:function(){var t=this._map,e=t.options.crs,i=this._tileSize=this.getTileSize(),n=this._tileZoom,o=this._map.getPixelWorldBounds(this._tileZoom);o&&(this._globalTileRange=this._pxBoundsToTileRange(o)),this._wrapX=e.wrapLng&&!this.options.noWrap&&[Math.floor(t.project([0,e.wrapLng[0]],n).x/i.x),Math.ceil(t.project([0,e.wrapLng[1]],n).x/i.y)],this._wrapY=e.wrapLat&&!this.options.noWrap&&[Math.floor(t.project([e.wrapLat[0],0],n).y/i.x),Math.ceil(t.project([e.wrapLat[1],0],n).y/i.y)]},_onMoveEnd:function(){!this._map||this._map._animatingZoom||this._update()},_getTiledPixelBounds:function(t){var e=this._map,i=e._animatingZoom?Math.max(e._animateToZoom,e.getZoom()):e.getZoom(),n=e.getZoomScale(i,this._tileZoom),o=e.project(t,this._tileZoom).floor(),l=e.getSize().divideBy(n*2);return new F(o.subtract(l),o.add(l))},_update:function(t){var e=this._map;if(e){var i=this._clampZoom(e.getZoom());if(t===void 0&&(t=e.getCenter()),this._tileZoom!==void 0){var n=this._getTiledPixelBounds(t),o=this._pxBoundsToTileRange(n),l=o.getCenter(),c=[],d=this.options.keepBuffer,m=new F(o.getBottomLeft().subtract([d,-d]),o.getTopRight().add([d,-d]));if(!(isFinite(o.min.x)&&isFinite(o.min.y)&&isFinite(o.max.x)&&isFinite(o.max.y)))throw new Error("Attempted to load an infinite number of tiles");for(var g in this._tiles){var w=this._tiles[g].coords;(w.z!==this._tileZoom||!m.contains(new M(w.x,w.y)))&&(this._tiles[g].current=!1)}if(Math.abs(i-this._tileZoom)>1){this._setView(t,i);return}for(var P=o.min.y;P<=o.max.y;P++)for(var z=o.min.x;z<=o.max.x;z++){var et=new M(z,P);if(et.z=this._tileZoom,!!this._isValidTile(et)){var J=this._tiles[this._tileCoordsToKey(et)];J?J.current=!0:c.push(et)}}if(c.sort(function(ot,Jt){return ot.distanceTo(l)-Jt.distanceTo(l)}),c.length!==0){this._loading||(this._loading=!0,this.fire("loading"));var ut=document.createDocumentFragment();for(z=0;z<c.length;z++)this._addTile(c[z],ut);this._level.el.appendChild(ut)}}}},_isValidTile:function(t){var e=this._map.options.crs;if(!e.infinite){var i=this._globalTileRange;if(!e.wrapLng&&(t.x<i.min.x||t.x>i.max.x)||!e.wrapLat&&(t.y<i.min.y||t.y>i.max.y))return!1}if(!this.options.bounds)return!0;var n=this._tileCoordsToBounds(t);return j(this.options.bounds).overlaps(n)},_keyToBounds:function(t){return this._tileCoordsToBounds(this._keyToTileCoords(t))},_tileCoordsToNwSe:function(t){var e=this._map,i=this.getTileSize(),n=t.scaleBy(i),o=n.add(i),l=e.unproject(n,t.z),c=e.unproject(o,t.z);return[l,c]},_tileCoordsToBounds:function(t){var e=this._tileCoordsToNwSe(t),i=new nt(e[0],e[1]);return this.options.noWrap||(i=this._map.wrapLatLngBounds(i)),i},_tileCoordsToKey:function(t){return t.x+":"+t.y+":"+t.z},_keyToTileCoords:function(t){var e=t.split(":"),i=new M(+e[0],+e[1]);return i.z=+e[2],i},_removeTile:function(t){var e=this._tiles[t];e&&(H(e.el),delete this._tiles[t],this.fire("tileunload",{tile:e.el,coords:this._keyToTileCoords(t)}))},_initTile:function(t){A(t,"leaflet-tile");var e=this.getTileSize();t.style.width=e.x+"px",t.style.height=e.y+"px",t.onselectstart=y,t.onmousemove=y,x.ielt9&&this.options.opacity<1&&lt(t,this.options.opacity)},_addTile:function(t,e){var i=this._getTilePos(t),n=this._tileCoordsToKey(t),o=this.createTile(this._wrapCoords(t),f(this._tileReady,this,t));this._initTile(o),this.createTile.length<2&&tt(f(this._tileReady,this,t,null,o)),G(o,i),this._tiles[n]={el:o,coords:t,current:!0},e.appendChild(o),this.fire("tileloadstart",{tile:o,coords:t})},_tileReady:function(t,e,i){e&&this.fire("tileerror",{error:e,tile:i,coords:t});var n=this._tileCoordsToKey(t);i=this._tiles[n],i&&(i.loaded=+new Date,this._map._fadeAnimated?(lt(i.el,0),at(this._fadeFrame),this._fadeFrame=tt(this._updateOpacity,this)):(i.active=!0,this._pruneTiles()),e||(A(i.el,"leaflet-tile-loaded"),this.fire("tileload",{tile:i.el,coords:t})),this._noTilesToLoad()&&(this._loading=!1,this.fire("load"),x.ielt9||!this._map._fadeAnimated?tt(this._pruneTiles,this):setTimeout(f(this._pruneTiles,this),250)))},_getTilePos:function(t){return t.scaleBy(this.getTileSize()).subtract(this._level.origin)},_wrapCoords:function(t){var e=new M(this._wrapX?k(t.x,this._wrapX):t.x,this._wrapY?k(t.y,this._wrapY):t.y);return e.z=t.z,e},_pxBoundsToTileRange:function(t){var e=this.getTileSize();return new F(t.min.unscaleBy(e).floor(),t.max.unscaleBy(e).ceil().subtract([1,1]))},_noTilesToLoad:function(){for(var t in this._tiles)if(!this._tiles[t].loaded)return!1;return!0}});function ys(t){return new me(t)}var Yt=me.extend({options:{minZoom:0,maxZoom:18,subdomains:"abc",errorTileUrl:"",zoomOffset:0,tms:!1,zoomReverse:!1,detectRetina:!1,crossOrigin:!1,referrerPolicy:!1},initialize:function(t,e){this._url=t,e=O(this,e),e.detectRetina&&x.retina&&e.maxZoom>0?(e.tileSize=Math.floor(e.tileSize/2),e.zoomReverse?(e.zoomOffset--,e.minZoom=Math.min(e.maxZoom,e.minZoom+1)):(e.zoomOffset++,e.maxZoom=Math.max(e.minZoom,e.maxZoom-1)),e.minZoom=Math.max(0,e.minZoom)):e.zoomReverse?e.minZoom=Math.min(e.maxZoom,e.minZoom):e.maxZoom=Math.max(e.minZoom,e.maxZoom),typeof e.subdomains=="string"&&(e.subdomains=e.subdomains.split("")),this.on("tileunload",this._onTileRemove)},setUrl:function(t,e){return this._url===t&&e===void 0&&(e=!0),this._url=t,e||this.redraw(),this},createTile:function(t,e){var i=document.createElement("img");return C(i,"load",f(this._tileOnLoad,this,e,i)),C(i,"error",f(this._tileOnError,this,e,i)),(this.options.crossOrigin||this.options.crossOrigin==="")&&(i.crossOrigin=this.options.crossOrigin===!0?"":this.options.crossOrigin),typeof this.options.referrerPolicy=="string"&&(i.referrerPolicy=this.options.referrerPolicy),i.alt="",i.src=this.getTileUrl(t),i},getTileUrl:function(t){var e={r:x.retina?"@2x":"",s:this._getSubdomain(t),x:t.x,y:t.y,z:this._getZoomForUrl()};if(this._map&&!this._map.options.crs.infinite){var i=this._globalTileRange.max.y-t.y;this.options.tms&&(e.y=i),e["-y"]=i}return Ae(this._url,u(e,this.options))},_tileOnLoad:function(t,e){x.ielt9?setTimeout(f(t,this,null,e),0):t(null,e)},_tileOnError:function(t,e,i){var n=this.options.errorTileUrl;n&&e.getAttribute("src")!==n&&(e.src=n),t(i,e)},_onTileRemove:function(t){t.tile.onload=null},_getZoomForUrl:function(){var t=this._tileZoom,e=this.options.maxZoom,i=this.options.zoomReverse,n=this.options.zoomOffset;return i&&(t=e-t),t+n},_getSubdomain:function(t){var e=Math.abs(t.x+t.y)%this.options.subdomains.length;return this.options.subdomains[e]},_abortLoading:function(){var t,e;for(t in this._tiles)if(this._tiles[t].coords.z!==this._tileZoom&&(e=this._tiles[t].el,e.onload=y,e.onerror=y,!e.complete)){e.src=Pt;var i=this._tiles[t].coords;H(e),delete this._tiles[t],this.fire("tileabort",{tile:e,coords:i})}},_removeTile:function(t){var e=this._tiles[t];if(e)return e.el.setAttribute("src",Pt),me.prototype._removeTile.call(this,t)},_tileReady:function(t,e,i){if(!(!this._map||i&&i.getAttribute("src")===Pt))return me.prototype._tileReady.call(this,t,e,i)}});function Vn(t,e){return new Yt(t,e)}var Kn=Yt.extend({defaultWmsParams:{service:"WMS",request:"GetMap",layers:"",styles:"",format:"image/jpeg",transparent:!1,version:"1.1.1"},options:{crs:null,uppercase:!1},initialize:function(t,e){this._url=t;var i=u({},this.defaultWmsParams);for(var n in e)n in this.options||(i[n]=e[n]);e=O(this,e);var o=e.detectRetina&&x.retina?2:1,l=this.getTileSize();i.width=l.x*o,i.height=l.y*o,this.wmsParams=i},onAdd:function(t){this._crs=this.options.crs||t.options.crs,this._wmsVersion=parseFloat(this.wmsParams.version);var e=this._wmsVersion>=1.3?"crs":"srs";this.wmsParams[e]=this._crs.code,Yt.prototype.onAdd.call(this,t)},getTileUrl:function(t){var e=this._tileCoordsToNwSe(t),i=this._crs,n=it(i.project(e[0]),i.project(e[1])),o=n.min,l=n.max,c=(this._wmsVersion>=1.3&&this._crs===Fn?[o.y,o.x,l.y,l.x]:[o.x,o.y,l.x,l.y]).join(","),d=Yt.prototype.getTileUrl.call(this,t);return d+pt(this.wmsParams,d,this.options.uppercase)+(this.options.uppercase?"&BBOX=":"&bbox=")+c},setParams:function(t,e){return u(this.wmsParams,t),e||this.redraw(),this}});function ws(t,e){return new Kn(t,e)}Yt.WMS=Kn,Vn.wms=ws;var Lt=dt.extend({options:{padding:.1},initialize:function(t){O(this,t),_(this),this._layers=this._layers||{}},onAdd:function(){this._container||(this._initContainer(),A(this._container,"leaflet-zoom-animated")),this.getPane().appendChild(this._container),this._update(),this.on("update",this._updatePaths,this)},onRemove:function(){this.off("update",this._updatePaths,this),this._destroyContainer()},getEvents:function(){var t={viewreset:this._reset,zoom:this._onZoom,moveend:this._update,zoomend:this._onZoomEnd};return this._zoomAnimated&&(t.zoomanim=this._onAnimZoom),t},_onAnimZoom:function(t){this._updateTransform(t.center,t.zoom)},_onZoom:function(){this._updateTransform(this._map.getCenter(),this._map.getZoom())},_updateTransform:function(t,e){var i=this._map.getZoomScale(e,this._zoom),n=this._map.getSize().multiplyBy(.5+this.options.padding),o=this._map.project(this._center,e),l=n.multiplyBy(-i).add(o).subtract(this._map._getNewPixelOrigin(t,e));x.any3d?zt(this._container,l,i):G(this._container,l)},_reset:function(){this._update(),this._updateTransform(this._center,this._zoom);for(var t in this._layers)this._layers[t]._reset()},_onZoomEnd:function(){for(var t in this._layers)this._layers[t]._project()},_updatePaths:function(){for(var t in this._layers)this._layers[t]._update()},_update:function(){var t=this.options.padding,e=this._map.getSize(),i=this._map.containerPointToLayerPoint(e.multiplyBy(-t)).round();this._bounds=new F(i,i.add(e.multiplyBy(1+t*2)).round()),this._center=this._map.getCenter(),this._zoom=this._map.getZoom()}}),Yn=Lt.extend({options:{tolerance:0},getEvents:function(){var t=Lt.prototype.getEvents.call(this);return t.viewprereset=this._onViewPreReset,t},_onViewPreReset:function(){this._postponeUpdatePaths=!0},onAdd:function(){Lt.prototype.onAdd.call(this),this._draw()},_initContainer:function(){var t=this._container=document.createElement("canvas");C(t,"mousemove",this._onMouseMove,this),C(t,"click dblclick mousedown mouseup contextmenu",this._onClick,this),C(t,"mouseout",this._handleMouseOut,this),t._leaflet_disable_events=!0,this._ctx=t.getContext("2d")},_destroyContainer:function(){at(this._redrawRequest),delete this._ctx,H(this._container),D(this._container),delete this._container},_updatePaths:function(){if(!this._postponeUpdatePaths){var t;this._redrawBounds=null;for(var e in this._layers)t=this._layers[e],t._update();this._redraw()}},_update:function(){if(!(this._map._animatingZoom&&this._bounds)){Lt.prototype._update.call(this);var t=this._bounds,e=this._container,i=t.getSize(),n=x.retina?2:1;G(e,t.min),e.width=n*i.x,e.height=n*i.y,e.style.width=i.x+"px",e.style.height=i.y+"px",x.retina&&this._ctx.scale(2,2),this._ctx.translate(-t.min.x,-t.min.y),this.fire("update")}},_reset:function(){Lt.prototype._reset.call(this),this._postponeUpdatePaths&&(this._postponeUpdatePaths=!1,this._updatePaths())},_initPath:function(t){this._updateDashArray(t),this._layers[_(t)]=t;var e=t._order={layer:t,prev:this._drawLast,next:null};this._drawLast&&(this._drawLast.next=e),this._drawLast=e,this._drawFirst=this._drawFirst||this._drawLast},_addPath:function(t){this._requestRedraw(t)},_removePath:function(t){var e=t._order,i=e.next,n=e.prev;i?i.prev=n:this._drawLast=n,n?n.next=i:this._drawFirst=i,delete t._order,delete this._layers[_(t)],this._requestRedraw(t)},_updatePath:function(t){this._extendRedrawBounds(t),t._project(),t._update(),this._requestRedraw(t)},_updateStyle:function(t){this._updateDashArray(t),this._requestRedraw(t)},_updateDashArray:function(t){if(typeof t.options.dashArray=="string"){var e=t.options.dashArray.split(/[, ]+/),i=[],n,o;for(o=0;o<e.length;o++){if(n=Number(e[o]),isNaN(n))return;i.push(n)}t.options._dashArray=i}else t.options._dashArray=t.options.dashArray},_requestRedraw:function(t){this._map&&(this._extendRedrawBounds(t),this._redrawRequest=this._redrawRequest||tt(this._redraw,this))},_extendRedrawBounds:function(t){if(t._pxBounds){var e=(t.options.weight||0)+1;this._redrawBounds=this._redrawBounds||new F,this._redrawBounds.extend(t._pxBounds.min.subtract([e,e])),this._redrawBounds.extend(t._pxBounds.max.add([e,e]))}},_redraw:function(){this._redrawRequest=null,this._redrawBounds&&(this._redrawBounds.min._floor(),this._redrawBounds.max._ceil()),this._clear(),this._draw(),this._redrawBounds=null},_clear:function(){var t=this._redrawBounds;if(t){var e=t.getSize();this._ctx.clearRect(t.min.x,t.min.y,e.x,e.y)}else this._ctx.save(),this._ctx.setTransform(1,0,0,1,0,0),this._ctx.clearRect(0,0,this._container.width,this._container.height),this._ctx.restore()},_draw:function(){var t,e=this._redrawBounds;if(this._ctx.save(),e){var i=e.getSize();this._ctx.beginPath(),this._ctx.rect(e.min.x,e.min.y,i.x,i.y),this._ctx.clip()}this._drawing=!0;for(var n=this._drawFirst;n;n=n.next)t=n.layer,(!e||t._pxBounds&&t._pxBounds.intersects(e))&&t._updatePath();this._drawing=!1,this._ctx.restore()},_updatePoly:function(t,e){if(this._drawing){var i,n,o,l,c=t._parts,d=c.length,m=this._ctx;if(d){for(m.beginPath(),i=0;i<d;i++){for(n=0,o=c[i].length;n<o;n++)l=c[i][n],m[n?"lineTo":"moveTo"](l.x,l.y);e&&m.closePath()}this._fillStroke(m,t)}}},_updateCircle:function(t){if(!(!this._drawing||t._empty())){var e=t._point,i=this._ctx,n=Math.max(Math.round(t._radius),1),o=(Math.max(Math.round(t._radiusY),1)||n)/n;o!==1&&(i.save(),i.scale(1,o)),i.beginPath(),i.arc(e.x,e.y/o,n,0,Math.PI*2,!1),o!==1&&i.restore(),this._fillStroke(i,t)}},_fillStroke:function(t,e){var i=e.options;i.fill&&(t.globalAlpha=i.fillOpacity,t.fillStyle=i.fillColor||i.color,t.fill(i.fillRule||"evenodd")),i.stroke&&i.weight!==0&&(t.setLineDash&&t.setLineDash(e.options&&e.options._dashArray||[]),t.globalAlpha=i.opacity,t.lineWidth=i.weight,t.strokeStyle=i.color,t.lineCap=i.lineCap,t.lineJoin=i.lineJoin,t.stroke())},_onClick:function(t){for(var e=this._map.mouseEventToLayerPoint(t),i,n,o=this._drawFirst;o;o=o.next)i=o.layer,i.options.interactive&&i._containsPoint(e)&&(!(t.type==="click"||t.type==="preclick")||!this._map._draggableMoved(i))&&(n=i);this._fireEvent(n?[n]:!1,t)},_onMouseMove:function(t){if(!(!this._map||this._map.dragging.moving()||this._map._animatingZoom)){var e=this._map.mouseEventToLayerPoint(t);this._handleMouseHover(t,e)}},_handleMouseOut:function(t){var e=this._hoveredLayer;e&&(q(this._container,"leaflet-interactive"),this._fireEvent([e],t,"mouseout"),this._hoveredLayer=null,this._mouseHoverThrottled=!1)},_handleMouseHover:function(t,e){if(!this._mouseHoverThrottled){for(var i,n,o=this._drawFirst;o;o=o.next)i=o.layer,i.options.interactive&&i._containsPoint(e)&&(n=i);n!==this._hoveredLayer&&(this._handleMouseOut(t),n&&(A(this._container,"leaflet-interactive"),this._fireEvent([n],t,"mouseover"),this._hoveredLayer=n)),this._fireEvent(this._hoveredLayer?[this._hoveredLayer]:!1,t),this._mouseHoverThrottled=!0,setTimeout(f(function(){this._mouseHoverThrottled=!1},this),32)}},_fireEvent:function(t,e,i){this._map._fireDOMEvent(e,i||e.type,t)},_bringToFront:function(t){var e=t._order;if(e){var i=e.next,n=e.prev;if(i)i.prev=n;else return;n?n.next=i:i&&(this._drawFirst=i),e.prev=this._drawLast,this._drawLast.next=e,e.next=null,this._drawLast=e,this._requestRedraw(t)}},_bringToBack:function(t){var e=t._order;if(e){var i=e.next,n=e.prev;if(n)n.next=i;else return;i?i.prev=n:n&&(this._drawLast=n),e.prev=null,e.next=this._drawFirst,this._drawFirst.prev=e,this._drawFirst=e,this._requestRedraw(t)}}});function Jn(t){return x.canvas?new Yn(t):null}var _e=(function(){try{return document.namespaces.add("lvml","urn:schemas-microsoft-com:vml"),function(t){return document.createElement("<lvml:"+t+' class="lvml">')}}catch{}return function(t){return document.createElement("<"+t+' xmlns="urn:schemas-microsoft.com:vml" class="lvml">')}})(),bs={_initContainer:function(){this._container=Z("div","leaflet-vml-container")},_update:function(){this._map._animatingZoom||(Lt.prototype._update.call(this),this.fire("update"))},_initPath:function(t){var e=t._container=_e("shape");A(e,"leaflet-vml-shape "+(this.options.className||"")),e.coordsize="1 1",t._path=_e("path"),e.appendChild(t._path),this._updateStyle(t),this._layers[_(t)]=t},_addPath:function(t){var e=t._container;this._container.appendChild(e),t.options.interactive&&t.addInteractiveTarget(e)},_removePath:function(t){var e=t._container;H(e),t.removeInteractiveTarget(e),delete this._layers[_(t)]},_updateStyle:function(t){var e=t._stroke,i=t._fill,n=t.options,o=t._container;o.stroked=!!n.stroke,o.filled=!!n.fill,n.stroke?(e||(e=t._stroke=_e("stroke")),o.appendChild(e),e.weight=n.weight+"px",e.color=n.color,e.opacity=n.opacity,n.dashArray?e.dashStyle=rt(n.dashArray)?n.dashArray.join(" "):n.dashArray.replace(/( *, *)/g," "):e.dashStyle="",e.endcap=n.lineCap.replace("butt","flat"),e.joinstyle=n.lineJoin):e&&(o.removeChild(e),t._stroke=null),n.fill?(i||(i=t._fill=_e("fill")),o.appendChild(i),i.color=n.fillColor||n.color,i.opacity=n.fillOpacity):i&&(o.removeChild(i),t._fill=null)},_updateCircle:function(t){var e=t._point.round(),i=Math.round(t._radius),n=Math.round(t._radiusY||i);this._setPath(t,t._empty()?"M0 0":"AL "+e.x+","+e.y+" "+i+","+n+" 0,"+65535*360)},_setPath:function(t,e){t._path.v=e},_bringToFront:function(t){Wt(t._container)},_bringToBack:function(t){qt(t._container)}},Ye=x.vml?_e:tn,ge=Lt.extend({_initContainer:function(){this._container=Ye("svg"),this._container.setAttribute("pointer-events","none"),this._rootGroup=Ye("g"),this._container.appendChild(this._rootGroup)},_destroyContainer:function(){H(this._container),D(this._container),delete this._container,delete this._rootGroup,delete this._svgSize},_update:function(){if(!(this._map._animatingZoom&&this._bounds)){Lt.prototype._update.call(this);var t=this._bounds,e=t.getSize(),i=this._container;(!this._svgSize||!this._svgSize.equals(e))&&(this._svgSize=e,i.setAttribute("width",e.x),i.setAttribute("height",e.y)),G(i,t.min),i.setAttribute("viewBox",[t.min.x,t.min.y,e.x,e.y].join(" ")),this.fire("update")}},_initPath:function(t){var e=t._path=Ye("path");t.options.className&&A(e,t.options.className),t.options.interactive&&A(e,"leaflet-interactive"),this._updateStyle(t),this._layers[_(t)]=t},_addPath:function(t){this._rootGroup||this._initContainer(),this._rootGroup.appendChild(t._path),t.addInteractiveTarget(t._path)},_removePath:function(t){H(t._path),t.removeInteractiveTarget(t._path),delete this._layers[_(t)]},_updatePath:function(t){t._project(),t._update()},_updateStyle:function(t){var e=t._path,i=t.options;e&&(i.stroke?(e.setAttribute("stroke",i.color),e.setAttribute("stroke-opacity",i.opacity),e.setAttribute("stroke-width",i.weight),e.setAttribute("stroke-linecap",i.lineCap),e.setAttribute("stroke-linejoin",i.lineJoin),i.dashArray?e.setAttribute("stroke-dasharray",i.dashArray):e.removeAttribute("stroke-dasharray"),i.dashOffset?e.setAttribute("stroke-dashoffset",i.dashOffset):e.removeAttribute("stroke-dashoffset")):e.setAttribute("stroke","none"),i.fill?(e.setAttribute("fill",i.fillColor||i.color),e.setAttribute("fill-opacity",i.fillOpacity),e.setAttribute("fill-rule",i.fillRule||"evenodd")):e.setAttribute("fill","none"))},_updatePoly:function(t,e){this._setPath(t,en(t._parts,e))},_updateCircle:function(t){var e=t._point,i=Math.max(Math.round(t._radius),1),n=Math.max(Math.round(t._radiusY),1)||i,o="a"+i+","+n+" 0 1,0 ",l=t._empty()?"M0 0":"M"+(e.x-i)+","+e.y+o+i*2+",0 "+o+-i*2+",0 ";this._setPath(t,l)},_setPath:function(t,e){t._path.setAttribute("d",e)},_bringToFront:function(t){Wt(t._path)},_bringToBack:function(t){qt(t._path)}});x.vml&&ge.include(bs);function Xn(t){return x.svg||x.vml?new ge(t):null}B.include({getRenderer:function(t){var e=t.options.renderer||this._getPaneRenderer(t.options.pane)||this.options.renderer||this._renderer;return e||(e=this._renderer=this._createRenderer()),this.hasLayer(e)||this.addLayer(e),e},_getPaneRenderer:function(t){if(t==="overlayPane"||t===void 0)return!1;var e=this._paneRenderers[t];return e===void 0&&(e=this._createRenderer({pane:t}),this._paneRenderers[t]=e),e},_createRenderer:function(t){return this.options.preferCanvas&&Jn(t)||Xn(t)}});var Qn=Vt.extend({initialize:function(t,e){Vt.prototype.initialize.call(this,this._boundsToLatLngs(t),e)},setBounds:function(t){return this.setLatLngs(this._boundsToLatLngs(t))},_boundsToLatLngs:function(t){return t=j(t),[t.getSouthWest(),t.getNorthWest(),t.getNorthEast(),t.getSouthEast()]}});function xs(t,e){return new Qn(t,e)}ge.create=Ye,ge.pointsToPath=en,kt.geometryToLayer=Ue,kt.coordsToLatLng=Ei,kt.coordsToLatLngs=We,kt.latLngToCoords=Oi,kt.latLngsToCoords=qe,kt.getFeature=Kt,kt.asFeature=je,B.mergeOptions({boxZoom:!0});var to=_t.extend({initialize:function(t){this._map=t,this._container=t._container,this._pane=t._panes.overlayPane,this._resetStateTimeout=0,t.on("unload",this._destroy,this)},addHooks:function(){C(this._container,"mousedown",this._onMouseDown,this)},removeHooks:function(){D(this._container,"mousedown",this._onMouseDown,this)},moved:function(){return this._moved},_destroy:function(){H(this._pane),delete this._pane},_resetState:function(){this._resetStateTimeout=0,this._moved=!1},_clearDeferredResetState:function(){this._resetStateTimeout!==0&&(clearTimeout(this._resetStateTimeout),this._resetStateTimeout=0)},_onMouseDown:function(t){if(!t.shiftKey||t.which!==1&&t.button!==1)return!1;this._clearDeferredResetState(),this._resetState(),le(),mi(),this._startPoint=this._map.mouseEventToContainerPoint(t),C(document,{contextmenu:$t,mousemove:this._onMouseMove,mouseup:this._onMouseUp,keydown:this._onKeyDown},this)},_onMouseMove:function(t){this._moved||(this._moved=!0,this._box=Z("div","leaflet-zoom-box",this._container),A(this._container,"leaflet-crosshair"),this._map.fire("boxzoomstart")),this._point=this._map.mouseEventToContainerPoint(t);var e=new F(this._point,this._startPoint),i=e.getSize();G(this._box,e.min),this._box.style.width=i.x+"px",this._box.style.height=i.y+"px"},_finish:function(){this._moved&&(H(this._box),q(this._container,"leaflet-crosshair")),he(),_i(),D(document,{contextmenu:$t,mousemove:this._onMouseMove,mouseup:this._onMouseUp,keydown:this._onKeyDown},this)},_onMouseUp:function(t){if(!(t.which!==1&&t.button!==1)&&(this._finish(),!!this._moved)){this._clearDeferredResetState(),this._resetStateTimeout=setTimeout(f(this._resetState,this),0);var e=new nt(this._map.containerPointToLatLng(this._startPoint),this._map.containerPointToLatLng(this._point));this._map.fitBounds(e).fire("boxzoomend",{boxZoomBounds:e})}},_onKeyDown:function(t){t.keyCode===27&&(this._finish(),this._clearDeferredResetState(),this._resetState())}});B.addInitHook("addHandler","boxZoom",to),B.mergeOptions({doubleClickZoom:!0});var eo=_t.extend({addHooks:function(){this._map.on("dblclick",this._onDoubleClick,this)},removeHooks:function(){this._map.off("dblclick",this._onDoubleClick,this)},_onDoubleClick:function(t){var e=this._map,i=e.getZoom(),n=e.options.zoomDelta,o=t.originalEvent.shiftKey?i-n:i+n;e.options.doubleClickZoom==="center"?e.setZoom(o):e.setZoomAround(t.containerPoint,o)}});B.addInitHook("addHandler","doubleClickZoom",eo),B.mergeOptions({dragging:!0,inertia:!0,inertiaDeceleration:3400,inertiaMaxSpeed:1/0,easeLinearity:.2,worldCopyJump:!1,maxBoundsViscosity:0});var io=_t.extend({addHooks:function(){if(!this._draggable){var t=this._map;this._draggable=new St(t._mapPane,t._container),this._draggable.on({dragstart:this._onDragStart,drag:this._onDrag,dragend:this._onDragEnd},this),this._draggable.on("predrag",this._onPreDragLimit,this),t.options.worldCopyJump&&(this._draggable.on("predrag",this._onPreDragWrap,this),t.on("zoomend",this._onZoomEnd,this),t.whenReady(this._onZoomEnd,this))}A(this._map._container,"leaflet-grab leaflet-touch-drag"),this._draggable.enable(),this._positions=[],this._times=[]},removeHooks:function(){q(this._map._container,"leaflet-grab"),q(this._map._container,"leaflet-touch-drag"),this._draggable.disable()},moved:function(){return this._draggable&&this._draggable._moved},moving:function(){return this._draggable&&this._draggable._moving},_onDragStart:function(){var t=this._map;if(t._stop(),this._map.options.maxBounds&&this._map.options.maxBoundsViscosity){var e=j(this._map.options.maxBounds);this._offsetLimit=it(this._map.latLngToContainerPoint(e.getNorthWest()).multiplyBy(-1),this._map.latLngToContainerPoint(e.getSouthEast()).multiplyBy(-1).add(this._map.getSize())),this._viscosity=Math.min(1,Math.max(0,this._map.options.maxBoundsViscosity))}else this._offsetLimit=null;t.fire("movestart").fire("dragstart"),t.options.inertia&&(this._positions=[],this._times=[])},_onDrag:function(t){if(this._map.options.inertia){var e=this._lastTime=+new Date,i=this._lastPos=this._draggable._absPos||this._draggable._newPos;this._positions.push(i),this._times.push(e),this._prunePositions(e)}this._map.fire("move",t).fire("drag",t)},_prunePositions:function(t){for(;this._positions.length>1&&t-this._times[0]>50;)this._positions.shift(),this._times.shift()},_onZoomEnd:function(){var t=this._map.getSize().divideBy(2),e=this._map.latLngToLayerPoint([0,0]);this._initialWorldOffset=e.subtract(t).x,this._worldWidth=this._map.getPixelWorldBounds().getSize().x},_viscousLimit:function(t,e){return t-(t-e)*this._viscosity},_onPreDragLimit:function(){if(!(!this._viscosity||!this._offsetLimit)){var t=this._draggable._newPos.subtract(this._draggable._startPos),e=this._offsetLimit;t.x<e.min.x&&(t.x=this._viscousLimit(t.x,e.min.x)),t.y<e.min.y&&(t.y=this._viscousLimit(t.y,e.min.y)),t.x>e.max.x&&(t.x=this._viscousLimit(t.x,e.max.x)),t.y>e.max.y&&(t.y=this._viscousLimit(t.y,e.max.y)),this._draggable._newPos=this._draggable._startPos.add(t)}},_onPreDragWrap:function(){var t=this._worldWidth,e=Math.round(t/2),i=this._initialWorldOffset,n=this._draggable._newPos.x,o=(n-e+i)%t+e-i,l=(n+e+i)%t-e-i,c=Math.abs(o+i)<Math.abs(l+i)?o:l;this._draggable._absPos=this._draggable._newPos.clone(),this._draggable._newPos.x=c},_onDragEnd:function(t){var e=this._map,i=e.options,n=!i.inertia||t.noInertia||this._times.length<2;if(e.fire("dragend",t),n)e.fire("moveend");else{this._prunePositions(+new Date);var o=this._lastPos.subtract(this._positions[0]),l=(this._lastTime-this._times[0])/1e3,c=i.easeLinearity,d=o.multiplyBy(c/l),m=d.distanceTo([0,0]),g=Math.min(i.inertiaMaxSpeed,m),w=d.multiplyBy(g/m),P=g/(i.inertiaDeceleration*c),z=w.multiplyBy(-P/2).round();!z.x&&!z.y?e.fire("moveend"):(z=e._limitOffset(z,e.options.maxBounds),tt(function(){e.panBy(z,{duration:P,easeLinearity:c,noMoveStart:!0,animate:!0})}))}}});B.addInitHook("addHandler","dragging",io),B.mergeOptions({keyboard:!0,keyboardPanDelta:80});var no=_t.extend({keyCodes:{left:[37],right:[39],down:[40],up:[38],zoomIn:[187,107,61,171],zoomOut:[189,109,54,173]},initialize:function(t){this._map=t,this._setPanDelta(t.options.keyboardPanDelta),this._setZoomDelta(t.options.zoomDelta)},addHooks:function(){var t=this._map._container;t.tabIndex<=0&&(t.tabIndex="0"),C(t,{focus:this._onFocus,blur:this._onBlur,mousedown:this._onMouseDown},this),this._map.on({focus:this._addHooks,blur:this._removeHooks},this)},removeHooks:function(){this._removeHooks(),D(this._map._container,{focus:this._onFocus,blur:this._onBlur,mousedown:this._onMouseDown},this),this._map.off({focus:this._addHooks,blur:this._removeHooks},this)},_onMouseDown:function(){if(!this._focused){var t=document.body,e=document.documentElement,i=t.scrollTop||e.scrollTop,n=t.scrollLeft||e.scrollLeft;this._map._container.focus(),window.scrollTo(n,i)}},_onFocus:function(){this._focused=!0,this._map.fire("focus")},_onBlur:function(){this._focused=!1,this._map.fire("blur")},_setPanDelta:function(t){var e=this._panKeys={},i=this.keyCodes,n,o;for(n=0,o=i.left.length;n<o;n++)e[i.left[n]]=[-1*t,0];for(n=0,o=i.right.length;n<o;n++)e[i.right[n]]=[t,0];for(n=0,o=i.down.length;n<o;n++)e[i.down[n]]=[0,t];for(n=0,o=i.up.length;n<o;n++)e[i.up[n]]=[0,-1*t]},_setZoomDelta:function(t){var e=this._zoomKeys={},i=this.keyCodes,n,o;for(n=0,o=i.zoomIn.length;n<o;n++)e[i.zoomIn[n]]=t;for(n=0,o=i.zoomOut.length;n<o;n++)e[i.zoomOut[n]]=-t},_addHooks:function(){C(document,"keydown",this._onKeyDown,this)},_removeHooks:function(){D(document,"keydown",this._onKeyDown,this)},_onKeyDown:function(t){if(!(t.altKey||t.ctrlKey||t.metaKey)){var e=t.keyCode,i=this._map,n;if(e in this._panKeys){if(!i._panAnim||!i._panAnim._inProgress)if(n=this._panKeys[e],t.shiftKey&&(n=T(n).multiplyBy(3)),i.options.maxBounds&&(n=i._limitOffset(T(n),i.options.maxBounds)),i.options.worldCopyJump){var o=i.wrapLatLng(i.unproject(i.project(i.getCenter()).add(n)));i.panTo(o)}else i.panBy(n)}else if(e in this._zoomKeys)i.setZoom(i.getZoom()+(t.shiftKey?3:1)*this._zoomKeys[e]);else if(e===27&&i._popup&&i._popup.options.closeOnEscapeKey)i.closePopup();else return;$t(t)}}});B.addInitHook("addHandler","keyboard",no),B.mergeOptions({scrollWheelZoom:!0,wheelDebounceTime:40,wheelPxPerZoomLevel:60});var oo=_t.extend({addHooks:function(){C(this._map._container,"wheel",this._onWheelScroll,this),this._delta=0},removeHooks:function(){D(this._map._container,"wheel",this._onWheelScroll,this)},_onWheelScroll:function(t){var e=Mn(t),i=this._map.options.wheelDebounceTime;this._delta+=e,this._lastMousePos=this._map.mouseEventToContainerPoint(t),this._startTime||(this._startTime=+new Date);var n=Math.max(i-(+new Date-this._startTime),0);clearTimeout(this._timer),this._timer=setTimeout(f(this._performZoom,this),n),$t(t)},_performZoom:function(){var t=this._map,e=t.getZoom(),i=this._map.options.zoomSnap||0;t._stop();var n=this._delta/(this._map.options.wheelPxPerZoomLevel*4),o=4*Math.log(2/(1+Math.exp(-Math.abs(n))))/Math.LN2,l=i?Math.ceil(o/i)*i:o,c=t._limitZoom(e+(this._delta>0?l:-l))-e;this._delta=0,this._startTime=null,c&&(t.options.scrollWheelZoom==="center"?t.setZoom(e+c):t.setZoomAround(this._lastMousePos,e+c))}});B.addInitHook("addHandler","scrollWheelZoom",oo);var ks=600;B.mergeOptions({tapHold:x.touchNative&&x.safari&&x.mobile,tapTolerance:15});var ro=_t.extend({addHooks:function(){C(this._map._container,"touchstart",this._onDown,this)},removeHooks:function(){D(this._map._container,"touchstart",this._onDown,this)},_onDown:function(t){if(clearTimeout(this._holdTimeout),t.touches.length===1){var e=t.touches[0];this._startPos=this._newPos=new M(e.clientX,e.clientY),this._holdTimeout=setTimeout(f(function(){this._cancel(),this._isTapValid()&&(C(document,"touchend",X),C(document,"touchend touchcancel",this._cancelClickPrevent),this._simulateEvent("contextmenu",e))},this),ks),C(document,"touchend touchcancel contextmenu",this._cancel,this),C(document,"touchmove",this._onMove,this)}},_cancelClickPrevent:function t(){D(document,"touchend",X),D(document,"touchend touchcancel",t)},_cancel:function(){clearTimeout(this._holdTimeout),D(document,"touchend touchcancel contextmenu",this._cancel,this),D(document,"touchmove",this._onMove,this)},_onMove:function(t){var e=t.touches[0];this._newPos=new M(e.clientX,e.clientY)},_isTapValid:function(){return this._newPos.distanceTo(this._startPos)<=this._map.options.tapTolerance},_simulateEvent:function(t,e){var i=new MouseEvent(t,{bubbles:!0,cancelable:!0,view:window,screenX:e.screenX,screenY:e.screenY,clientX:e.clientX,clientY:e.clientY});i._simulated=!0,e.target.dispatchEvent(i)}});B.addInitHook("addHandler","tapHold",ro),B.mergeOptions({touchZoom:x.touch,bounceAtZoomLimits:!0});var so=_t.extend({addHooks:function(){A(this._map._container,"leaflet-touch-zoom"),C(this._map._container,"touchstart",this._onTouchStart,this)},removeHooks:function(){q(this._map._container,"leaflet-touch-zoom"),D(this._map._container,"touchstart",this._onTouchStart,this)},_onTouchStart:function(t){var e=this._map;if(!(!t.touches||t.touches.length!==2||e._animatingZoom||this._zooming)){var i=e.mouseEventToContainerPoint(t.touches[0]),n=e.mouseEventToContainerPoint(t.touches[1]);this._centerPoint=e.getSize()._divideBy(2),this._startLatLng=e.containerPointToLatLng(this._centerPoint),e.options.touchZoom!=="center"&&(this._pinchStartLatLng=e.containerPointToLatLng(i.add(n)._divideBy(2))),this._startDist=i.distanceTo(n),this._startZoom=e.getZoom(),this._moved=!1,this._zooming=!0,e._stop(),C(document,"touchmove",this._onTouchMove,this),C(document,"touchend touchcancel",this._onTouchEnd,this),X(t)}},_onTouchMove:function(t){if(!(!t.touches||t.touches.length!==2||!this._zooming)){var e=this._map,i=e.mouseEventToContainerPoint(t.touches[0]),n=e.mouseEventToContainerPoint(t.touches[1]),o=i.distanceTo(n)/this._startDist;if(this._zoom=e.getScaleZoom(o,this._startZoom),!e.options.bounceAtZoomLimits&&(this._zoom<e.getMinZoom()&&o<1||this._zoom>e.getMaxZoom()&&o>1)&&(this._zoom=e._limitZoom(this._zoom)),e.options.touchZoom==="center"){if(this._center=this._startLatLng,o===1)return}else{var l=i._add(n)._divideBy(2)._subtract(this._centerPoint);if(o===1&&l.x===0&&l.y===0)return;this._center=e.unproject(e.project(this._pinchStartLatLng,this._zoom).subtract(l),this._zoom)}this._moved||(e._moveStart(!0,!1),this._moved=!0),at(this._animRequest);var c=f(e._move,e,this._center,this._zoom,{pinch:!0,round:!1},void 0);this._animRequest=tt(c,this,!0),X(t)}},_onTouchEnd:function(){if(!this._moved||!this._zooming){this._zooming=!1;return}this._zooming=!1,at(this._animRequest),D(document,"touchmove",this._onTouchMove,this),D(document,"touchend touchcancel",this._onTouchEnd,this),this._map.options.zoomAnimation?this._map._animateZoom(this._center,this._map._limitZoom(this._zoom),!0,this._map.options.zoomSnap):this._map._resetView(this._center,this._map._limitZoom(this._zoom))}});B.addInitHook("addHandler","touchZoom",so),B.BoxZoom=to,B.DoubleClickZoom=eo,B.Drag=io,B.Keyboard=no,B.ScrollWheelZoom=oo,B.TapHold=ro,B.TouchZoom=so,a.Bounds=F,a.Browser=x,a.CRS=wt,a.Canvas=Yn,a.Circle=zi,a.CircleMarker=He,a.Class=yt,a.Control=ct,a.DivIcon=Gn,a.DivOverlay=gt,a.DomEvent=Fr,a.DomUtil=Nr,a.Draggable=St,a.Evented=ne,a.FeatureGroup=bt,a.GeoJSON=kt,a.GridLayer=me,a.Handler=_t,a.Icon=Gt,a.ImageOverlay=Ge,a.LatLng=N,a.LatLngBounds=nt,a.Layer=dt,a.LayerGroup=jt,a.LineUtil=ts,a.Map=B,a.Marker=Fe,a.Mixin=Vr,a.Path=Mt,a.Point=M,a.PolyUtil=Kr,a.Polygon=Vt,a.Polyline=xt,a.Popup=Ve,a.PosAnimation=Cn,a.Projection=es,a.Rectangle=Qn,a.Renderer=Lt,a.SVG=ge,a.SVGOverlay=jn,a.TileLayer=Yt,a.Tooltip=Ke,a.Transformation=ni,a.Util=ar,a.VideoOverlay=qn,a.bind=f,a.bounds=it,a.canvas=Jn,a.circle=hs,a.circleMarker=ls,a.control=de,a.divIcon=vs,a.extend=u,a.featureGroup=rs,a.geoJSON=Wn,a.geoJson=ds,a.gridLayer=ys,a.icon=ss,a.imageOverlay=ps,a.latLng=I,a.latLngBounds=j,a.layerGroup=os,a.map=Hr,a.marker=as,a.point=T,a.polygon=cs,a.polyline=us,a.popup=_s,a.rectangle=xs,a.setOptions=O,a.stamp=_,a.svg=Xn,a.svgOverlay=ms,a.tileLayer=Vn,a.tooltip=gs,a.transformation=oe,a.version=h,a.videoOverlay=fs;var Ls=window.L;a.noConflict=function(){return window.L=Ls,this},window.L=a}))})(ye,ye.exports)),ye.exports}var ca=ua();const E=la(ca);Is();const da={CHILD:2},pa=s=>(...r)=>({_$litDirective$:s,values:r});class fa{constructor(r){}get _$AU(){return this._$AM._$AU}_$AT(r,a,h){this._$Ct=r,this._$AM=a,this._$Ci=h}_$AS(r,a){return this.update(r,a)}update(r,a){return this.render(...a)}}class Ui extends fa{constructor(r){if(super(r),this.it=K,r.type!==da.CHILD)throw Error(this.constructor.directiveName+"() can only be used in child bindings")}render(r){if(r===K||r==null)return this._t=void 0,this.it=r;if(r===Dt)return r;if(typeof r!="string")throw Error(this.constructor.directiveName+"() called with a non-string value");if(r===this.it)return this._t;this.it=r;const a=[r];return a.raw=a,this._t={_$litType$:this.constructor.resultType,strings:a,values:[]}}}Ui.directiveName="unsafeHTML",Ui.resultType=1;const Y=pa(Ui),ma=`<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
`,_a=`<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg"><path d="M15 3h6v6M9 21H3v-6M21 3l-7 7M3 21l7-7"/></svg>
`,ga=`<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg"><path d="M4 14h6v6M20 10h-6V4M14 10l7-7M10 14l-7 7"/></svg>
`,va=`<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="3"/><line x1="12" y1="2" x2="12" y2="5"/><line x1="12" y1="19" x2="12" y2="22"/><line x1="2" y1="12" x2="5" y2="12"/><line x1="19" y1="12" x2="22" y2="12"/></svg>
`,ya=`<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg"><polygon points="12 2 2 7 12 12 22 7 12 2"/><polyline points="2 17 12 22 22 17"/><polyline points="2 12 12 17 22 12"/></svg>
`,wa=`<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
`,ba=`<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg"><line x1="5" y1="12" x2="19" y2="12"/></svg>
`,xa=`<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" aria-hidden="true">
  <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
</svg>
`,ka=`<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="24" height="24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 18v-5.25m0 0a6.01 6.01 0 0 0 1.5-.189m-1.5.189a6.01 6.01 0 0 1-1.5-.189m3.75 7.478a12.06 12.06 0 0 1-4.5 0m3.75 2.383a14.406 14.406 0 0 1-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 1 0-7.517 0c.85.493 1.509 1.333 1.509 2.316V18"/>
</svg>
`,La=`<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="24" height="24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
  <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
</svg>
`,Pa=`<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="24" height="24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
  <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75a4.5 4.5 0 0 1-4.884 4.484c-1.076-.091-2.264.071-2.95.904l-7.152 8.684a2.548 2.548 0 1 1-3.586-3.586l8.684-7.152c.833-.686.995-1.874.904-2.95a4.5 4.5 0 0 1 6.336-4.486l-3.276 3.276a3.004 3.004 0 0 0 2.25 2.25l3.276-3.276c.256.565.398 1.192.398 1.852Z"/>
  <path stroke-linecap="round" stroke-linejoin="round" d="M4.867 19.125h.008v.008h-.008v-.008Z"/>
</svg>
`,Ta=`<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
  <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456ZM16.894 20.567 16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z"/>
</svg>
`,Sa=`<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="24" height="24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
  <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z"/>
</svg>
`,Ma=`<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
  <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"/>
</svg>
`,Ca=`<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418"/>
</svg>
`,Aa=`<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
  <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12"/>
</svg>
`,za=`<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
  <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z"/>
</svg>
`,Ea=`<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
  <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/>
</svg>
`,Oa=`<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
  <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z"/>
</svg>
`,$a={"magnifying-glass":$`${Y(ma)}`,"arrows-pointing-out":$`${Y(_a)}`,"arrows-pointing-in":$`${Y(ga)}`,"map-pin":$`${Y(va)}`,"squares-2x2":$`${Y(ya)}`,plus:$`${Y(wa)}`,minus:$`${Y(ba)}`,"x-mark":$`${Y(xa)}`,"light-bulb":$`${Y(ka)}`,trash:$`${Y(La)}`,wrench:$`${Y(Pa)}`,sparkles:$`${Y(Ta)}`,"archive-box":$`${Y(Sa)}`,"building-office":$`${Y(Ma)}`,"globe-alt":$`${Y(Ca)}`,truck:$`${Y(Aa)}`,"shield-check":$`${Y(za)}`,"document-text":$`${Y(Ea)}`,"question-mark-circle":$`${Y(Oa)}`};function Q(s){return $a[s]??$``}function Ft(s,r=[0]){if(typeof s._refreshMapSize=="function"){s._refreshMapSize(r);return}r.forEach(a=>{setTimeout(()=>s._map?.invalidateSize(),a)})}function Ia(s){const r=s.labels||{},a=!s.isFullscreen,h=a?r.fullscreen||"Fullscreen":r.close_fullscreen||"Chiudi";return $`
        <button class="ctrl-btn" type="button"
            @click=${()=>Fo(s)}
            aria-label="${h}"
            title="${h}">
            ${Q(a?"arrows-pointing-out":"arrows-pointing-in")}
        </button>
    `}async function Fo(s){const r=Ho(s),a=!s.isFullscreen;if(r){if(a){if(s._previousBodyOverflow=document.body.style.overflow||"",s._previousHtmlOverflow=document.documentElement.style.overflow||"",document.documentElement.classList.add("geo-map-fullscreen-active"),document.body.style.overflow="hidden",document.documentElement.style.overflow="hidden",r.requestFullscreen&&!document.fullscreenElement)try{await r.requestFullscreen()}catch{Wi(s)}}else{if(document.fullscreenElement&&document.exitFullscreen)try{await document.exitFullscreen()}catch{}Wi(s)}s.isFullscreen=a,s.requestUpdate?.(),s.dispatchEvent(new CustomEvent("fullscreen-changed",{detail:{isFullscreen:s.isFullscreen},bubbles:!0,composed:!0})),Ft(s,[0,160,380,700])}}function zl(s){const r=Ho(s),a=document.fullscreenElement===r;document.fullscreenElement&&!a||(s.isFullscreen!==a&&(s.isFullscreen=a,s.requestUpdate?.()),a||Wi(s),Ft(s,[0,160,380]))}function Ho(s){return s.renderRoot?.querySelector?.(".map-container")||s.querySelector?.(".map-container")||null}function Wi(s){document.documentElement.classList.remove("geo-map-fullscreen-active"),document.body.style.overflow=s._previousBodyOverflow||"",document.documentElement.style.overflow=s._previousHtmlOverflow||""}function Uo(s){s._map&&(s._map.zoomIn(),Ft(s,[150]))}function Wo(s){s._map&&(s._map.zoomOut(),Ft(s,[150]))}function Ba(s){const r=s.labels||{};return $`
        <button class="ctrl-btn" type="button"
            @click=${()=>Uo(s)}
            aria-label="${r.zoom_in||"Zoom In"}"
            title="${r.zoom_in||"Zoom In"}">
            ${Q("plus")}
        </button>
    `}function Za(s){const r=s.labels||{};return $`
        <button class="ctrl-btn" type="button"
            @click=${()=>Wo(s)}
            aria-label="${r.zoom_out||"Zoom Out"}"
            title="${r.zoom_out||"Zoom Out"}">
            ${Q("minus")}
        </button>
    `}function qo(s){return $`${Ba(s)}${Za(s)}`}const Zi=["street","humanitarian","satellite","topo"];function jo(s){if(!s._map||!s._layers)return;const r=Zi.indexOf(s._currentLayer),a=Zi[(r+1)%Zi.length],h=s._layers[s._currentLayer];h&&s._map.removeLayer(h);const u=s._layers[a];u&&!u._map&&u.addTo(s._map),s._currentLayer=a,Ft(s,[0,120,300])}function Ra(s){return $`<button class="ctrl-btn" type="button"
        @click=${()=>jo(s)}
        aria-label="${s.labels?.switch_layer||"Cambia Layer"}"
        title="${s.labels?.switch_layer||"Cambia Layer"}">
        ${Q("squares-2x2")}
    </button>`}const Po={it:{fullscreen:"Schermo intero",close_fullscreen:"Esci da schermo intero",use_location:"Usa la mia posizione",switch_layer:"Cambia layer",zoom_in:"Aumenta zoom",zoom_out:"Diminuisci zoom",search:"Cerca",search_placeholder:"Cerca indirizzo...",close_search:"Chiudi ricerca",legend_title:"Stati segnalazione",geo_unsupported:"Geolocalizzazione non disponibile su questo browser.",location_unavailable:"Non riesco a leggere la tua posizione da questo dispositivo. Cerca un indirizzo o tocca la mappa.",geo_failed:"Non è stato possibile rilevare la posizione. Riprova.",geo_denied:"Consenti l’accesso alla posizione nel browser e riprova.",geo_blocked:"Posizione bloccata per questo sito: clicca il lucchetto accanto all’indirizzo, imposta Posizione su Consenti e ricarica la pagina."},en:{fullscreen:"Fullscreen",close_fullscreen:"Exit fullscreen",use_location:"Use my location",switch_layer:"Change layer",zoom_in:"Zoom in",zoom_out:"Zoom out",search:"Search",search_placeholder:"Search address...",close_search:"Close search",legend_title:"Report statuses",geo_unsupported:"Geolocation is not available in this browser.",location_unavailable:"I can't read your location from this device. Search for an address or tap the map.",geo_failed:"Could not detect your location. Please try again.",geo_denied:"Allow location access in your browser and try again.",geo_blocked:"Location is blocked for this site: click the lock next to the address, set Location to Allow and reload the page."},de:{fullscreen:"Vollbild",close_fullscreen:"Vollbild beenden",use_location:"Meinen Standort verwenden",switch_layer:"Ebene wechseln",zoom_in:"Vergrößern",zoom_out:"Verkleinern",search:"Suchen",search_placeholder:"Adresse suchen...",close_search:"Suche schließen",legend_title:"Status der Meldungen",geo_unsupported:"Die Standortbestimmung ist in diesem Browser nicht verfügbar.",location_unavailable:"Ich kann Ihren Standort von diesem Gerät nicht lesen. Suchen Sie eine Adresse oder tippen Sie auf die Karte.",geo_failed:"Der Standort konnte nicht ermittelt werden. Bitte versuchen Sie es erneut.",geo_denied:"Erlauben Sie den Zugriff auf den Standort im Browser und versuchen Sie es erneut.",geo_blocked:"Der Standort ist für diese Website blockiert: Klicken Sie auf das Schloss neben der Adresse, setzen Sie Standort auf Zulassen und laden Sie die Seite neu."},es:{fullscreen:"Pantalla completa",close_fullscreen:"Salir de pantalla completa",use_location:"Usar mi ubicación",switch_layer:"Cambiar capa",zoom_in:"Acercar",zoom_out:"Alejar",search:"Buscar",search_placeholder:"Buscar dirección...",close_search:"Cerrar búsqueda",legend_title:"Estados de las incidencias",geo_unsupported:"La geolocalización no está disponible en este navegador.",location_unavailable:"No puedo leer tu ubicación desde este dispositivo. Busca una dirección o toca el mapa.",geo_failed:"No se pudo detectar tu ubicación. Inténtalo de nuevo.",geo_denied:"Permite el acceso a la ubicación en el navegador e inténtalo de nuevo.",geo_blocked:"La ubicación está bloqueada para este sitio: haz clic en el candado junto a la dirección, establece Ubicación en Permitir y recarga la página."}};function Go(){const s=(document.documentElement.lang||"it").slice(0,2).toLowerCase();return{...Po[s]??Po.it}}const Na=12,Da=3e3,To=s=>typeof s=="number"||typeof s=="string"&&s.trim()!==""?Number(s):Number.NaN,So=s=>Math.round(s*100)/100;function Fa(s){const r=To(s?.latitude??s?.lat),a=To(s?.longitude??s?.lng??s?.lon);return!Number.isFinite(r)||!Number.isFinite(a)||Math.abs(r)>90||Math.abs(a)>180||r===0&&a===0?null:{lat:So(r),lng:So(a)}}async function Ha(s,{timeoutMs:r=Da,fetchImpl:a=globalThis.fetch}={}){if(typeof s!="string"||!/^https?:\/\//i.test(s))return null;const h=new AbortController,u=setTimeout(()=>h.abort(),r);try{const p=await a(s,{signal:h.signal,credentials:"omit",referrerPolicy:"no-referrer",cache:"no-store"});return p.ok?Fa(await p.json()):null}catch{return null}finally{clearTimeout(u)}}function qi(s,r){const a={...Go(),...s.labels||{}};if(r?s._locationError=a.location_unavailable||"":s._locationError=s._lat==null&&a.no_position||"",r&&s._map&&!s._isUserCentered){const h=s._initialView;s._lat!=null&&s._lng!=null?s._map.setView([s._lat,s._lng],Math.max(s._map.getZoom(),s.zoom),{animate:!1}):h&&s._map.setView([h.lat,h.lng],h.zoom,{animate:!1})}s.requestUpdate?.()}async function Ua(s,{auto:r}){if(!s.approximateLocationUrl){qi(s,!r);return}if(r){if(s._ipAutoTried)return;s._ipAutoTried=!0}r||(s.isLocating=!0,s.requestUpdate?.()),s._ipRequest??(s._ipRequest=Ha(s.approximateLocationUrl).then(h=>(h||(s._ipRequest=null),h)));const a=await s._ipRequest;if(r||(s.isLocating=!1),!a){qi(s,!r);return}if(!s._map||s._lat!=null||r&&s._userMovedMap){s.requestUpdate?.();return}s._map.setView([a.lat,a.lng],Na,{animate:!1}),s._locationError=s.labels?.approximate_note||"",Ft(s,[150]),s.requestUpdate?.()}function Vo(s,r={}){const{showLoading:a=!0,auto:h=!1}=r;return!window.isSecureContext||!navigator.geolocation?Ua(s,{auto:h}):s.isLocating||s._geolocRequested&&!a?Promise.resolve():(s._geolocRequested=!0,a&&(s.isLocating=!0,s.requestUpdate()),new Promise(u=>navigator.geolocation.getCurrentPosition(p=>{const f=p.coords.latitude,v=p.coords.longitude;if(typeof s._handleMapInteraction=="function"&&s._handleMapInteraction(f,v,"geolocation"),s.geolocated=!0,s._geolocRequested=!1,s._locationError="",a&&(s.isLocating=!1),s.requestUpdate?.(),s._map){const _=Number.isFinite(s.zoom)?Math.max(s.zoom,14):15;s._map.setView([f,v],_,{animate:!1}),s._isUserCentered=!0,Ft(s,[150])}u()},p=>{s._geolocRequested=!1,a&&(s.isLocating=!1),s.geolocated=!1,qi(s,!h),u()},{enableHighAccuracy:!0,timeout:1e4,maximumAge:3e5})))}function Wa(s){return $`<button class="ctrl-btn" type="button"
        @click=${()=>Vo(s)}
        ?disabled=${s.isLocating}
        aria-label="${s.labels?.use_location||"Mia posizione"}"
        title="${s.labels?.use_location||"Mia posizione"}">
        ${s.isLocating?$`<svg class="animate-spin" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10" opacity=".25"/><path d="M4 12a8 8 0 018-8" opacity=".75"/></svg>`:Q("map-pin")}
    </button>`}const Ko=3,qa=350,ja="https://nominatim.openstreetmap.org/search";function Ga(s){const r=s.renderRoot??s,a=typeof r.querySelector=="function"?r.querySelector.bind(r):null;if(!a)return;let h=a(".map-picker-search-input");h||(h=a(".search-box")?.querySelector("input")??null),h&&typeof h.focus=="function"&&(h.focus(),document.activeElement!==h&&setTimeout(()=>h.focus(),50))}function Yo(s){if(s.showSearch===!1)return;const r=s._searchOpen;s._searchOpen=!s._searchOpen,s._searchOpen||(s.searchQuery="",s.searchResults=[],s.showSearchResults=!1),s.requestUpdate?.(),s._searchOpen&&!r&&s.updateComplete?.then(()=>Ga(s))}function Jo(s){s._searchOpen=!1,s.searchQuery="",s.searchResults=[],s.showSearchResults=!1,s.requestUpdate?.()}function Va(s,r){if(r.key==="Escape"){Jo(s);return}r.key==="Enter"&&(r.preventDefault(),Yi(s,{selectFirst:!0}))}function Ka(s,r){s.searchQuery=r||"",s.showSearchResults=!1,s._searchDebounce&&clearTimeout(s._searchDebounce),s.searchQuery.trim().length>=Ko?s._searchDebounce=setTimeout(()=>{Yi(s,{selectFirst:!1})},qa):s.searchResults=[],s.requestUpdate?.()}async function Yi(s,r={}){const a=String(s.searchQuery||"").trim();if(a.length<Ko){s.searchResults=[],s.showSearchResults=!1,s.requestUpdate?.();return}s.isSearching=!0,s.requestUpdate?.();try{const h=await Ja(s,a);s.searchResults=Array.isArray(h)?h:[],s.showSearchResults=s.searchResults.length>0,r.selectFirst&&s.searchResults[0]&&Xo(s,s.searchResults[0])}catch(h){console.warn("[map-search] Address search failed",h),s.searchResults=[],s.showSearchResults=!1}finally{s.isSearching=!1,s.requestUpdate?.()}}function Xo(s,r){const a=Number.parseFloat(r.lat),h=Number.parseFloat(r.lon??r.lng);if(!Number.isFinite(a)||!Number.isFinite(h))return;const u=r.display_name||`${a}, ${h}`,p=Ya(r,a,h,u);s.searchQuery=u,s.searchResults=[],s.showSearchResults=!1,typeof s._handleSearchSelection=="function"?s._handleSearchSelection(r,a,h,p):typeof s._handleMapInteraction=="function"?s._handleMapInteraction(a,h,"search"):s._map&&s._map.setView([a,h],Math.max(s._map.getZoom(),16)),s.requestUpdate?.()}function Ya(s,r,a,h){const u=s&&typeof s.address=="object"&&s.address!==null?s.address:{},p=(...f)=>{for(const v of f)if(typeof v=="string"&&v.trim()!=="")return v;return null};return{lat:r,lng:a,latitude:r,longitude:a,address:h,display_name:s?.display_name??h,provider:"nominatim",place_id:s?.place_id??null,osm_type:s?.osm_type??null,osm_id:s?.osm_id??null,licence:s?.licence??null,importance:typeof s?.importance=="number"?s.importance:null,type:s?.type??null,class:s?.class??null,boundingbox:Array.isArray(s?.boundingbox)?s.boundingbox:null,street:p(u.road,u.pedestrian,u.footway,u.path,u.residential,u.highway),street_number:p(u.house_number),zip:p(u.postcode),postcode:p(u.postcode),city:p(u.city,u.town,u.village,u.municipality,u.hamlet,u.county),suburb:p(u.suburb,u.neighbourhood,u.quarter,u.city_district),province:p(u.province,u.county,u.state_district),state:p(u.state,u.region),country:p(u.country),country_code:p(u.country_code),address_details:u,raw:s}}async function Ja(s,r){if(typeof s.searchAddress=="function")return s.searchAddress(r);const a=new URL(ja);a.searchParams.set("format","json"),a.searchParams.set("addressdetails","1"),a.searchParams.set("limit","5"),a.searchParams.set("q",r);const h=await fetch(a.toString(),{headers:{"Accept-Language":document.documentElement.lang||"it"}});if(!h.ok)throw new Error(`HTTP ${h.status}`);return h.json()}const Qo=Object.freeze({updateSearchQuery:Ka,handleSearchKeydown:Va,executeAddressSearch:Yi,selectSearchResult:Xo,closeSearch:Jo,toggleSearch:Yo});function Xa(s,r=Qo){const a=s.labels||{},h=a.search_placeholder||"Cerca indirizzo...",u=Array.isArray(s.searchResults)?s.searchResults:[],p=!!(s.showSearchResults&&u.length>0);return $`
        <div class="search-box geo-address-search geo-search-expanded"
             @click="${f=>f.stopPropagation()}">
            <input
                type="text"
                class="map-picker-search-input"
                placeholder="${h}"
                aria-label="${h}"
                autocomplete="off"
                .value="${s.searchQuery||""}"
                @input="${f=>r.updateSearchQuery(s,f.target.value)}"
                @keydown="${f=>r.handleSearchKeydown(s,f)}"
            />
            <button
                class="ctrl-btn"
                type="button"
                aria-label="${a.search||"Cerca"}"
                title="${a.search||"Cerca"}"
                @click="${()=>r.executeAddressSearch(s,{selectFirst:!0})}"
            >
                ${s.isSearching?$`<svg class="animate-spin" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10" opacity=".25"/><path d="M4 12a8 8 0 018-8" opacity=".75"/></svg>`:Q("magnifying-glass")}
            </button>
            <button
                class="ctrl-btn geo-search-close"
                type="button"
                aria-label="${a.close_search||"Chiudi ricerca"}"
                title="${a.close_search||"Chiudi ricerca"}"
                @click="${()=>r.closeSearch(s)}"
            >
                ${Q("x-mark")}
            </button>

            ${p?$`
                <ul class="geo-address-search-results" role="listbox">
                    ${u.map(f=>$`
                        <li
                            role="option"
                            @click="${()=>r.selectSearchResult(s,f)}"
                            title="${f.display_name||""}"
                        >
                            ${f.display_name||`${f.lat}, ${f.lon}`}
                        </li>
                    `)}
                </ul>
            `:""}
        </div>
    `}function Qa(s){return s.showSearch!==!1?$`
        <button class="ctrl-btn" type="button"
            @click=${a=>{a.stopPropagation(),Yo(s)}}
            aria-label="${s.labels?.search||"Cerca indirizzo"}"
            title="${s.labels?.search||"Cerca indirizzo"}">
            ${Q("magnifying-glass")}
        </button>
    `:$``}const tl=[Qa,Ia,Wa,Ra,qo],el=[qo];function il(s){return $`
        <div class="layer-controls-overlay">
            ${(s.readonly?el:tl).map(r=>r(s))}
            <p class="map-control-status" role="status" aria-live="polite">${s._locationError||""}</p>
        </div>
    `}function nl(s){return{street:s.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",{maxZoom:19}),humanitarian:s.tileLayer("https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png",{maxZoom:19}),satellite:s.tileLayer("https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}",{maxZoom:19}),topo:s.tileLayer("https://server.arcgisonline.com/ArcGIS/rest/services/World_Topo_Map/MapServer/tile/{z}/{y}/{x}",{maxZoom:19})}}const ol=Ds`
    :host {
        display: block;
        width: 100%;
        --mp-z-index: 10;
        --mp-overlay-z-index: 1000;
        --mp-fullscreen-z-index: 999999;
    }

    .map-container {
        position: relative;
        width: 100%;
        height: var(--map-height, 400px);
        border-radius: 0.5rem;
        overflow: hidden;
        border: 1px solid #d1d5db;
        background: #f3f4f6;
        z-index: var(--mp-z-index);
    }

    .map-container.is-fullscreen {
        position: fixed !important;
        top: 0 !important;
        left: 0 !important;
        width: 100vw !important;
        height: 100vh !important;
        z-index: var(--mp-fullscreen-z-index, 999999) !important;
        border-radius: 0 !important;
    }

    .map-container:fullscreen {
        width: 100vw !important;
        height: 100vh !important;
        border-radius: 0 !important;
    }

    .map-picker-leaflet-pane {
        width: 100%;
        height: 100%;
        z-index: 1;
        background: #e5e7eb;
        opacity: 1;
    }

    /* Ritaglio solo i tile Leaflet: search/controlli restano sibling fuori dal clipping. */
    .map-picker-viewport {
        position: absolute;
        inset: 0;
        overflow: hidden;
        border-radius: inherit;
        z-index: 0;
    }

    .map-picker-leaflet-pane .leaflet-container,
    .map-picker-leaflet-pane .leaflet-pane,
    .map-picker-leaflet-pane .leaflet-layer,
    .map-picker-leaflet-pane .leaflet-tile,
    .map-picker-leaflet-pane .leaflet-tile-pane {
        opacity: 1 !important;
        filter: none !important;
    }

    .layer-controls-overlay {
        position: absolute;
        top: 1rem;
        left: 1rem;
        z-index: 3001 !important;
        display: flex !important;
        flex-direction: column;
        gap: 0.75rem;
        opacity: 1 !important;
        visibility: visible !important;
        pointer-events: auto !important;
    }

    .map-control-status {
        max-width: 15rem;
        margin: 0;
        padding: .5rem .65rem;
        border-radius: .5rem;
        background: #fff;
        color: #17324d;
        font-size: .8rem;
        line-height: 1.25;
        box-shadow: 0 4px 14px rgba(23, 50, 77, .16);
    }

    /* Area aria-live sempre nel DOM (gli screen reader annunciano solo il testo che cambia in un'area gia' presente): vuota non si vede. */
    .map-control-status:empty {
        padding: 0;
        box-shadow: none;
        background: transparent;
    }

    .ctrl-btn {
        width: 2.75rem;
        height: 2.75rem;
        background: #ffffff;
        border: 1px solid #94a3b8;
        border-radius: 0.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        color: #17324d;
        box-shadow: 0 8px 18px rgba(23, 50, 77, 0.22);
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        padding: 0;
        opacity: 1 !important;
        visibility: visible !important;
        position: relative;
        z-index: 3002;
    }

    .ctrl-btn:hover {
        background: white;
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
        color: #2563eb;
    }

    .ctrl-btn svg {
        width: 1.25rem !important;
        height: 1.25rem !important;
    }

    /* Fallback emoji/text solo se il pulsante non ha ancora un <svg> (icons da ?raw). */
    .ctrl-btn .ctrl-fallback {
        display: none !important;
        font-size: 1rem;
        font-weight: 700;
        line-height: 1;
    }

    .ctrl-btn:not(:has(svg)) .ctrl-fallback {
        display: inline-block !important;
    }

    .ctrl-btn svg {
        display: block;
    }

    .search-box {
        position: absolute;
        top: 1rem;
        right: 1rem;
        /* Sopra overlay controlli (3001) e overlay loading (2000), sotto fullscreen chrome */
        z-index: 3200 !important;
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        background: rgba(255, 255, 255, 0.9);
        padding: 0.5rem;
        border-radius: 1rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(8px);
        max-width: 300px;
        width: min(300px, calc(100% - 5rem));
        align-items: center;
    }

    .search-box input {
        flex: 1;
        border: 1px solid #d1d5db;
        border-radius: 0.5rem;
        padding: 0.5rem 0.75rem;
        font-size: 0.875rem;
        width: 100%;
        min-width: 0;
        outline: none;
        color: #17324d;
        background: #ffffff;
        line-height: 1.25rem;
    }

    .search-box .ctrl-btn {
        flex: 0 0 auto;
        width: 2.75rem;
        min-width: 2.75rem;
        height: 2.75rem;
    }

    .search-box .ctrl-btn svg {
        display: block;
        width: 1.25rem !important;
        height: 1.25rem !important;
        flex: 0 0 auto;
    }

    .geo-address-search-results {
        flex: 0 0 100%;
        max-height: 12rem;
        margin: 0;
        padding: 0.25rem 0;
        overflow: auto;
        list-style: none;
        border: 1px solid #d1d5db;
        border-radius: 0.75rem;
        background: #ffffff;
        color: #17324d;
        box-shadow: 0 10px 24px rgba(23, 50, 77, 0.16);
    }

    .geo-address-search-results li {
        padding: 0.55rem 0.75rem;
        cursor: pointer;
        font-size: 0.8125rem;
        line-height: 1.25;
    }

    .geo-address-search-results li:hover,
    .geo-address-search-results li:focus-visible {
        background: #eef6ff;
        color: #0050a4;
        outline: none;
    }

    html.geo-map-fullscreen-active,
    html.geo-map-fullscreen-active body {
        overflow: hidden !important;
    }

    .map-container.is-fullscreen .layer-controls-overlay,
    .map-container.is-fullscreen .search-box {
        z-index: 3002 !important;
    }

    .loading-overlay {
        position: absolute;
        inset: 0;
        background: rgba(255, 255, 255, 0.7);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 2000;
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
        transition: opacity 0.3s;
    }

    .loading-overlay.active {
        display: flex;
        opacity: 1;
        visibility: visible;
        pointer-events: auto;
    }

    .spinner {
        width: 2.5rem;
        height: 2.5rem;
        border: 4px solid #e5e7eb;
        border-top-color: #2563eb;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    .leaflet-container {
        font-family: inherit;
    }

    .leaflet-marker-icon.map-picker-marker {
        background: transparent;
        border: 0;
    }

    .map-picker-marker,
    .map-picker-marker__inner {
        display: block;
        width: 44px;
        height: 56px;
        filter: drop-shadow(0 4px 8px rgba(15, 23, 42, 0.32));
    }

    .map-picker-marker svg {
        width: 100%;
        height: 100%;
        display: block;
    }

    /* Cluster Circle - farmshops.eu style (no transform hover: fa "scappare" dal anchor Leaflet) */
    .circle, .geo-cluster-circle {
        color: #17324d;
        border: 3px solid #007a52;
        background: #ffffff;
        border-radius: 50%;
        width: 80px;
        height: 80px;
        font-family: 'Titillium Web', sans-serif;
        font-weight: 700;
        font-size: 18px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        box-sizing: border-box;
    }
    .circle:hover, .geo-cluster-circle:hover {
        box-shadow: 0 6px 16px rgba(0,0,0,0.22);
    }
    .circle strong, .geo-cluster-circle strong {
        line-height: 1;
    }

    .circle-dots, .geo-cluster-type-icons {
        display: flex;
        gap: 3px;
        justify-content: center;
        flex-wrap: wrap;
        max-width: 80%;
        margin-top: 4px;
    }

    .geo-cluster-type-icons svg,
    .geo-cluster-type-icons img,
    .geo-cluster-type-dot {
        display: block !important;
        width: 14px !important;
        height: 14px !important;
        max-width: 14px !important;
        max-height: 14px !important;
        min-width: 14px !important;
        min-height: 14px !important;
        flex: 0 0 auto !important;
        object-fit: contain;
    }

    .geo-cluster-type-tile {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 22px;
        height: 22px;
        border-radius: 5px;
        background: #fff;
        border: 1px solid #d9e2f0;
        box-shadow: 0 1px 2px rgba(15, 23, 42, 0.12);
        flex: 0 0 auto;
    }

    .geo-cluster-type-tile img {
        width: 14px !important;
        height: 14px !important;
        filter: none !important;
        opacity: 1 !important;
    }

    .geo-map-legend {
        background: #fff;
        padding: 8px 12px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        font-size: 13px;
        line-height: 1.4;
        max-height: min(220px, 40vh);
        overflow-y: auto;
        pointer-events: auto;
    }

    .geo-map-legend-title {
        display: block;
        margin-bottom: 6px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        color: #5c6f82;
    }

    .geo-map-legend-items {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .geo-map-legend-item {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .geo-map-legend-color {
        display: inline-block;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        flex-shrink: 0;
        border: 1px solid rgba(0, 0, 0, 0.08);
    }

    .geo-map-legend-label {
        font-size: 12px;
        color: #17324d;
        line-height: 1.2;
    }

    /* Leaflet cluster wrapper — anchor stabile, no transform */
    .leaflet-marker-icon.geo-cluster-wrapper {
        background: transparent !important;
        border: none !important;
    }
    .leaflet-marker-icon.geo-cluster-wrapper > div {
        transform-origin: center center;
    }

    /* Popup - farmshops.eu structure */
    .leaflet-popup-content-wrapper {
        padding: 0;
        overflow: hidden;
        border-radius: 0.75rem;
    }

    .leaflet-popup-content {
        margin: 0;
        width: 100% !important;
    }

    .geo-popup-header {
        background: #4ca7ce;
        padding: 0.75rem 2.5rem 0.75rem 1rem;
        color: #fff;
    }

    .geo-popup-header h1 {
        font-size: 1.1rem;
        margin: 0;
        color: #fff;
        font-weight: 700;
        line-height: 1.2;
    }

    .geo-popup-body {
        padding: 1rem;
        font-size: 0.875rem;
        color: #1e293b;
    }

    .geo-popup-section {
        margin-bottom: 1rem;
    }

    .geo-popup-section:last-child {
        margin-bottom: 0;
    }

    .geo-popup-label {
        font-weight: 700;
        display: block;
        margin-bottom: 0.25rem;
        color: #4ca7ce;
    }

    .geo-popup-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .geo-popup-footer {
        padding: 0.75rem 1rem;
        border-top: 1px solid #e2e8f0;
        background: #f8fafc;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .geo-popup-btn {
        display: inline-block;
        padding: 0.5rem 1rem;
        background: #4ca7ce;
        color: #fff !important;
        border-radius: 0.5rem;
        text-decoration: none !important;
        font-weight: 600;
        font-size: 0.75rem;
        transition: all 0.2s;
    }

    .geo-popup-btn:hover {
        background: #3a8fb3;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
`,rl=ol.cssText;Q("plus"),Q("minus"),Q("arrows-pointing-out"),Q("arrows-pointing-in"),Q("map-pin"),Q("squares-2x2"),Q("map-pin");const Mo=32,sl=18;function al(s){const r=String(s||"").trim();return r===""||!r.startsWith("/")||/["'<>]/.test(r)?null:r}function tr(s,r=Mo,a={}){const h=al(s);if(!h)return"";const u=Number(r)||Mo,p=a.monochrome===!0?"filter:brightness(0) saturate(100%);opacity:0.88;":"";return`<img src="${h}" alt="" class="geo-map-marker-glyph geo-map-marker-glyph--img" width="${u}" height="${u}" loading="lazy" decoding="async" style="width:${u}px;height:${u}px;max-width:${u}px;max-height:${u}px;${p}" />`}function ll(s,r="",a=sl){const h=tr(s,a,{monochrome:!1});return h?`<span class="geo-cluster-type-tile" title="${String(r||"").replace(/"/g,"&quot;")}" aria-hidden="true">${h}</span>`:""}const hl=/^#[0-9a-f]{3}([0-9a-f]{3})?$/i,ji=44,Me=44,er=Me,Le=22,ul=3,Rt="#0057b8",cl="M12 2C8.69 2 6 4.69 6 8c0 5.25 6 10 6 10s6-4.75 6-10c0-3.31-2.69-6-6-6zm0 8.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z";function dl(s,r=Rt){return hl.test(String(s||""))?s:r}function pl(s){return`<span class="geo-map-marker-designcomuni__initial" aria-hidden="true">${String(s||"?").trim().charAt(0).toUpperCase()||"?"}</span>`}function fl(s,r=Rt,a=null,h=""){const u=dl(r,Rt),p=tr(a,Le,{monochrome:!0}),f=p?"":pl(h),_=!p&&!a?`<svg class="geo-map-marker-designcomuni__glyph-svg" aria-hidden="true" width="${Le}" height="${Le}" viewBox="0 0 24 24"><path fill="currentColor" d="${cl}"></path></svg>`:"";return s.divIcon({html:`<div class="geo-map-marker-designcomuni" style="--marker-color:${u}" role="img" aria-label="Marker posizione segnalazione" aria-hidden="true">
            <div class="geo-map-marker-designcomuni__circle">
                <div class="geo-map-marker-designcomuni__icon">${p}${_}${f}</div>
            </div>
        </div>`,className:"geo-map-marker-wrapper geo-map-marker-wrapper--designcomuni",iconSize:[ji,er],iconAnchor:[ji/2,Me/2],popupAnchor:[0,-Me/2]})}const ml=`
    .geo-map-marker-wrapper--designcomuni {
        background: transparent !important;
        border: none !important;
    }
    .geo-map-marker-designcomuni {
        position: relative;
        width: ${ji}px;
        height: ${er}px;
        display: flex;
        align-items: center;
        justify-content: center;
        pointer-events: none;
        filter: drop-shadow(0 2px 4px rgba(0,0,0,0.3)) drop-shadow(0 4px 8px rgba(0,0,0,0.15));
        transition: transform 0.15s ease, filter 0.15s ease, box-shadow 0.15s ease;
    }
    @media (prefers-reduced-motion: reduce) {
        .geo-map-marker-designcomuni { transition: none !important; }
    }
    .geo-map-marker-designcomuni__circle {
        width: ${Me}px;
        height: ${Me}px;
        border-radius: 50%;
        background: var(--marker-color, ${Rt});
        border: ${ul}px solid #fff;
        box-shadow:
            0 0 0 1px color-mix(in srgb, var(--marker-color, ${Rt}) 30%, transparent),
            inset 0 1px 0 rgba(255,255,255,0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: box-shadow 0.15s ease, filter 0.15s ease;
    }
    .geo-map-marker-designcomuni__icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: ${Le}px;
        height: ${Le}px;
        color: #fff;
        filter: brightness(0) invert(1);
    }
    .geo-map-marker-designcomuni__glyph-svg {
        display: block;
        width: 100%;
        height: 100%;
    }
    .geo-map-marker-designcomuni__initial {
        font-size: 1rem;
        font-weight: 800;
        line-height: 1;
        color: #fff;
        font-family: 'Titillium Web', system-ui, sans-serif;
    }

    /* Hover */
    .leaflet-marker-icon.geo-map-marker-wrapper--designcomuni:hover .geo-map-marker-designcomuni {
        transform: scale(1.1);
        filter: drop-shadow(0 4px 8px rgba(0,0,0,0.35)) drop-shadow(0 8px 16px rgba(0,0,0,0.2));
    }
    @media (prefers-reduced-motion: reduce) {
        .leaflet-marker-icon.geo-map-marker-wrapper--designcomuni:hover .geo-map-marker-designcomuni {
            transform: none;
        }
    }

    /* Focus-visible (WCAG 2.1 AA) */
    .leaflet-marker-icon.geo-map-marker-wrapper--designcomuni:focus-visible {
        outline: none;
    }
    .leaflet-marker-icon.geo-map-marker-wrapper--designcomuni:focus-visible .geo-map-marker-designcomuni__circle {
        box-shadow:
            0 0 0 3px #fff,
            0 0 0 5px var(--marker-color, ${Rt}),
            0 0 12px rgba(0,0,0,0.2),
            inset 0 1px 0 rgba(255,255,255,0.3);
    }

    /* Dragging */
    .leaflet-marker-icon.geo-map-marker-wrapper--designcomuni.leaflet-marker-draggable.dragging .geo-map-marker-designcomuni {
        z-index: 1000;
        filter: drop-shadow(0 6px 12px rgba(0,0,0,0.4)) drop-shadow(0 12px 24px rgba(0,0,0,0.25));
    }

    /* Active/Selected pulse */
    .geo-map-marker-designcomuni--active .geo-map-marker-designcomuni__circle {
        animation: marker-pulse 2s ease-in-out infinite;
        box-shadow:
            0 0 0 3px #fff,
            0 0 0 6px var(--marker-color, ${Rt});
    }
    @keyframes marker-pulse {
        0%, 100% { box-shadow: 0 0 0 3px #fff, 0 0 0 6px var(--marker-color); }
        50% { box-shadow: 0 0 0 3px #fff, 0 0 0 10px color-mix(in srgb, var(--marker-color) 40%, transparent); }
    }
    @media (prefers-reduced-motion: reduce) {
        .geo-map-marker-designcomuni--active .geo-map-marker-designcomuni__circle {
            animation: none;
            box-shadow: 0 0 0 3px #fff, 0 0 0 6px var(--marker-color);
        }
    }

    /* Dark mode adjustments */
    @media (prefers-color-scheme: dark) {
        .geo-map-marker-designcomuni {
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.5)) drop-shadow(0 4px 8px rgba(0,0,0,0.3));
        }
        .leaflet-marker-icon.geo-map-marker-wrapper--designcomuni:focus-visible .geo-map-marker-designcomuni__circle {
            box-shadow:
                0 0 0 3px #fff,
                0 0 0 5px #4d9fff,
                0 0 12px rgba(0,0,0,0.4);
        }
    }

    /* Responsive by zoom (toggled via JS) */
    .geo-map-marker-designcomuni--zoom-low { width: 32px; height: 32px; }
    .geo-map-marker-designcomuni--zoom-low .geo-map-marker-designcomuni__circle { width: 32px; height: 32px; }
    .geo-map-marker-designcomuni--zoom-low .geo-map-marker-designcomuni__icon { width: 16px; height: 16px; }
    .geo-map-marker-designcomuni--zoom-high { width: 48px; height: 48px; }
    .geo-map-marker-designcomuni--zoom-high .geo-map-marker-designcomuni__circle { width: 48px; height: 48px; }
    .geo-map-marker-designcomuni--zoom-high .geo-map-marker-designcomuni__icon { width: 24px; height: 24px; }
`;function Xe(s={}){const r=s.type&&typeof s.type=="object"?s.type:null;if(r){const u=String(r.value??"other"),p=r.iconUrl??r.icon_url??null;return{value:u,label:String(r.label??u),iconUrl:typeof p=="string"&&p!==""?p:null}}const a=typeof s.type=="string"?s.type:"other",h=s.type_icon_url??null;return{value:a,label:String(s.type_label??a),iconUrl:typeof h=="string"&&h!==""?h:null}}const _l=/^#[0-9a-f]{3}([0-9a-f]{3})?$/i,Co={open:"#2563eb",pending:"#f59e0b",in_review:"#8b5cf6",in_progress:"#0ea5e9",on_hold:"#64748b",resolved:"#16a34a",closed:"#475569",reopened:"#dc2626",draft:"#94a3b8"},gl={gray:"#64748b",secondary:"#475569",warning:"#f59e0b",info:"#0ea5e9",orange:"#f97316",danger:"#dc2626",success:"#16a34a",primary:"#2563eb"};function Ao(s,r="#607d8b"){const a=String(s||"").trim().toLowerCase();return _l.test(a)?a:gl[a]??r}function Ri(s={}){const r=s.status&&typeof s.status=="object"?s.status:null;if(r){const h=String(r.value??"open");return{value:h,label:String(r.label??h),color:Ao(r.color,Co[h]??"#607d8b")}}const a=typeof s.status=="string"&&s.status!==""?s.status:"open";return{value:a,label:String(s.status_label??a),color:Ao(s.status_color,Co[a]??"#607d8b")}}const zo={it:{status:"Stato",type:"Tipologia",address:"Indirizzo",code:"Codice segnalazione",detail:"Dettagli",images:"Immagini",close:"Chiudi",openDetail:"Dettagli",openMaps:"Apri in mappe",noAddress:"Indirizzo non disponibile"},en:{status:"Status",type:"Report type",address:"Address",code:"Report code",detail:"Details",images:"Images",close:"Close",openDetail:"Details",openMaps:"Open in maps",noAddress:"Address not available"},de:{status:"Status",type:"Art der Meldung",address:"Adresse",code:"Meldungscode",detail:"Details",images:"Bilder",close:"Schließen",openDetail:"Details",openMaps:"In Karten öffnen",noAddress:"Adresse nicht verfügbar"},es:{status:"Estado",type:"Tipo de incidencia",address:"Dirección",code:"Código de la incidencia",detail:"Detalles",images:"Imágenes",close:"Cerrar",openDetail:"Detalles",openMaps:"Abrir en mapas",noAddress:"Dirección no disponible"}};function ir(){const s=(document.documentElement.lang||"it").slice(0,2).toLowerCase();return zo[s]??zo.it}function U(s){return String(s??"").replace(/&/g,"&amp;").replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/"/g,"&quot;")}function nr(s){const r=String(s.address||"").trim(),a=String(s.city||"").trim();return r&&a&&!r.toLowerCase().includes(a.toLowerCase())?`${r} — ${a}`:r||a}function Ji(s,r=56){const a=String(s.iconUrl||"").trim();return a===""?"":`<img src="${U(a)}" alt="" class="popup__type-icon" width="${r}" height="${r}" loading="lazy" decoding="async">`}function vl(s,r,{skipIfHeaderIcon:a=!1}={}){const h=U(s.label||""),u=String(s.iconUrl||"").trim()!=="";if(a&&u)return`
            <div class="popup__row popup__row--type popup__row--compact">
                <span class="popup__row-label">${U(r.type)}</span>
                <p class="popup__row-value">${h}</p>
            </div>
        `;const p=Ji(s,24);return`
        <div class="popup__row popup__row--type">
            <span class="popup__row-label">${U(r.type)}</span>
            <div class="popup__row-value popup__type-value">
                ${p}
                <span>${h}</span>
            </div>
        </div>
    `}function yl(s,r){const a=Number(s?.lat),h=Number(s?.lng);if(!Number.isFinite(a)||!Number.isFinite(h))return"";const u=`https://www.google.com/maps?q=${a},${h}`,p=`https://www.openstreetmap.org/?mlat=${a}&mlon=${h}#map=17/${a}/${h}`,f=`https://maps.openrouteservice.org/directions?n1=${h}&n2=${a}&n3=14&a=null,null,${h},${a}&b=0&c=0&k1=it-IT&k2=km`;return`
        <div class="popup__links-block">
            <span class="popup__row-label">${U(r.openMaps)}</span>
            <div class="popup__map-links">
                <a href="${p}" target="_blank" rel="noopener noreferrer" class="popup__map-link">OpenStreetMap</a>
                <a href="${f}" target="_blank" rel="noopener noreferrer" class="popup__map-link">OpenRouteService</a>
                <a href="${u}" target="_blank" rel="noopener noreferrer" class="popup__map-link">Google Maps</a>
            </div>
        </div>
    `}function wl(s,r,a){const h=nr(s),u=U(h!==""?h:a.noAddress),p=yl(r,a);return`
        <div class="popup__wrapper">
            <div class="popup__address-block">
                <span class="popup__row-label">${U(a.address)}</span>
                <p class="popup__row-value popup__address">${u}</p>
            </div>
            ${p}
        </div>
    `}function or(s,r){const a=U(s.label||s.value||"");return`
        <span class="popup__status" style="--status-color:${U(s.color||"#607d8b")}">
            <span class="popup__status-dot" aria-hidden="true"></span>
            <span class="popup__status-text">${a}</span>
        </span>
    `}function bl(s,r){const a=String(s.code||s.ticket_code||"").trim();return a===""?"":`
        <div class="popup__row popup__row--code">
            <span class="popup__row-label">${U(r.code)}</span>
            <p class="popup__row-value popup__code">${U(a)}</p>
        </div>
    `}function Ni(s,r){ir();const a=U(r.color||"#607d8b"),h=Ji(s,48);return`
        <article class="popup popup--loading" style="--status-color:${a}" aria-busy="true" data-popup-state="loading">
            <div class="popup__accent" aria-hidden="true"></div>
            <div class="popup__header">
                <div class="${h?"popup__header-bar popup__header-bar--with-icon":"popup__header-bar"}">
                    ${h?`<div class="popup__header-icon" aria-hidden="true">${h}</div>`:""}
                    <div class="popup__header-text">
                        <div class="popup__skeleton popup__skeleton--title"></div>
                        ${or(r)}
                    </div>
                </div>
            </div>
            <div class="popup__body">
                <div class="popup__skeleton popup__skeleton--line"></div>
                <div class="popup__skeleton popup__skeleton--line popup__skeleton--short"></div>
            </div>
        </article>
    `}function Eo(s,r,a,h=null,u={}){const p=ir(),f=U(h?.title||s.title||s.name||"—"),v=U(h?.description||s.description||s.content||""),_=U(a.color||"#607d8b"),b=String(s.detail_url||s.url||"").trim();let k="";const y=window.location.pathname.split("/").filter(Boolean)[0]||document.documentElement.lang||"it";if(b!=="")try{const vt=new URL(b,window.location.origin);vt.origin===window.location.origin&&(k=`${vt.pathname.replace(/^\/[a-z]{2}(?=\/)/i,`/${y}`)}${vt.search}${vt.hash}`)}catch{}k===""&&s.id!==void 0&&s.id!==null&&(k=`/${encodeURIComponent(y)}/tickets/${encodeURIComponent(String(s.id))}`);const S=k!=="",R=nr(s),W=U(R!==""?R:p.noAddress),O=Array.isArray(h?.images)?h.images:Array.isArray(s.images)?s.images:[],pt=v?`<p class="popup__description">${v}</p>`:"",Ht=S?`<a href="${U(k)}" class="popup__link popup__link--primary" style="color:#fff!important;background-color:#007a52!important">${U(p.openDetail)}</a>`:`<button type="button" class="popup__link popup__link--primary" style="color:#fff!important;background-color:#007a52!important" data-popup-open-detail>${U(p.openDetail)}</button>`,Ae=wl(s,u,p),rt=vl(r,p,{skipIfHeaderIcon:!0}),te=bl(s,p),Pt=Ji(r,44),ee=Pt?"popup__header-bar popup__header-bar--with-icon":"popup__header-bar",ze=R!==""?`<p class="popup__address-preview">${W}</p>`:"",Ee=O.length>0?`<div class="popup__hero"><img src="${U(O[0])}" alt="" loading="lazy" class="popup__hero-img" onerror="this.parentElement.remove()"></div>`:"",ie=O.length>1?`<div class="popup__gallery">${O.slice(1,4).map(vt=>`<img src="${U(vt)}" alt="" loading="lazy" class="popup__img" onerror="this.remove()">`).join("")}</div>`:"";return`
        <article class="popup" style="--status-color:${_}" role="dialog" aria-label="${f}">
            <div class="popup__accent" aria-hidden="true"></div>
            ${Ee}
            <div class="popup__header popup__header--headline">
                <div class="${ee}">
                    ${Pt?`<div class="popup__header-icon" aria-hidden="true">${Pt}</div>`:""}
                    <div class="popup__header-text">
                        ${or(a)}
                        <h2 class="popup__title popup__title--headline" style="color:#17324d!important">${f}</h2>
                        ${ze}
                    </div>
                </div>
            </div>
            <div class="popup__body">
                ${rt}
                ${te}
                ${Ae}
                ${pt}
                ${ie}
            </div>
            <footer class="popup__footer">
                ${Ht}
                <button type="button" class="popup__link popup__link--ghost" data-popup-close>
                    ${U(p.close)}
                </button>
            </footer>
        </article>
    `}const Oo=`
    .leaflet-popup.popup-wrapper {
        margin-bottom: 12px;
    }
    .leaflet-popup.popup-wrapper .leaflet-popup-content-wrapper {
        padding: 0;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 12px 40px rgba(15, 23, 42, 0.28);
        border: 1px solid rgba(15, 23, 42, 0.08);
        backdrop-filter: blur(8px);
    }
    .leaflet-popup.popup-wrapper .leaflet-popup-content {
        margin: 0 !important;
        padding: 0 !important;
        /* 4.5rem = margini pagina + bordo mappa: il popup non deve superare la larghezza reale della mappa (94vw la superava su mobile) */
        width: min(440px, calc(100vw - 4.5rem)) !important;
        min-width: 0;
        max-width: min(420px, calc(100vw - 4.5rem));
        min-height: 0 !important;
    }
    /* Popup piu' alto della mappa: scorre il contenuto, ma le azioni (Dettagli/Chiudi) restano sempre visibili */
    .leaflet-popup.popup-wrapper .leaflet-popup-scrolled .popup__footer {
        position: sticky;
        bottom: 0;
        z-index: 3;
        box-shadow: 0 -6px 12px rgba(15, 23, 42, 0.08);
    }
    /* Mappe strette: Leaflet lascia 72px a sinistra (autoPanPadding) per i controlli, il popup deve starci nel resto */
    @media (max-width: 480px) {
        .leaflet-popup.popup-wrapper .leaflet-popup-content {
            width: calc(100vw - 8.5rem) !important;
            max-width: calc(100vw - 8.5rem) !important;
        }
    }
    .leaflet-popup.popup-wrapper .leaflet-popup-content p {
        margin: 0 !important;
    }
    .leaflet-popup.popup-wrapper .leaflet-popup-tip {
        box-shadow: 0 4px 8px rgba(15, 23, 42, 0.15);
    }
    .leaflet-popup.popup-wrapper .leaflet-popup-close-button {
        color: #17324d !important;
        font-size: 1.4rem !important;
        font-weight: 400 !important;
        width: 2.5rem;
        height: 2.5rem;
        line-height: 2.5rem;
        padding: 0 !important;
        top: 0.5rem !important;
        right: 0.5rem !important;
        z-index: 3;
        transition: all 0.2s ease;
    }
    .leaflet-popup.popup-wrapper .leaflet-popup-close-button:hover {
        color: #007a52 !important;
        background: rgba(0, 122, 82, 0.12);
        border-radius: 8px;
        transform: scale(1.05);
    }
    .popup {
        font-family: 'Titillium Web', system-ui, sans-serif;
        color: #17324d; /* ENFORCE dark text — avoid white-on-white */
        background: #fff;
        position: relative;
        isolation: isolate;
    }
    .popup::before {
        content: '';
        position: absolute;
        inset: 0;
        border-radius: 16px;
        background: linear-gradient(135deg, rgba(255,255,255,0.4) 0%, rgba(255,255,255,0) 100%);
        pointer-events: none;
        z-index: -1;
    }
    .popup__accent {
        height: 6px;
        background: linear-gradient(90deg, var(--status-color, #007a52) 0%, color-mix(in srgb, var(--status-color, #007a52) 55%, #fff) 100%);
        position: relative;
        z-index: 1;
    }
    .popup__hero {
        position: relative;
        z-index: 1;
        max-height: 140px;
        overflow: hidden;
        background: #eef2f6;
    }
    .popup__hero-img {
        display: block;
        width: 100%;
        height: 140px;
        object-fit: cover;
    }
    .popup__header--headline {
        padding: 0.65rem 2.25rem 0.75rem 0.85rem !important;
    }
    .popup__title--headline {
        font-size: 1.0625rem !important;
        line-height: 1.3 !important;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }
    .popup__wrapper {
        padding: 0.5rem 1rem 0.65rem;
        border-bottom: 1px solid #eef2f6;
    }
    .popup__address-block {
        margin-bottom: 0.35rem;
    }
    .popup__address-block .popup__row-value {
        font-weight: 500;
        font-size: 0.875rem;
    }
    .leaflet-popup.popup-wrapper .popup__header,
    .dc-homepage-parity .leaflet-popup.popup-wrapper .popup__header,
    .popup__header {
        min-height: 0 !important;
        height: auto !important;
        max-height: none !important;
        padding: 0.4rem 2.25rem 0.1rem 0.85rem !important;
        border-bottom: 1px solid #d9e2f0;
        background: #fff;
        position: relative;
        z-index: 1;
        display: flow-root;
    }
    .popup__header-bar {
        display: grid;
        grid-template-columns: 1fr auto;
        grid-template-rows: auto;
        align-items: center;
        column-gap: 0.5rem;
        row-gap: 0;
        min-height: 0;
    }
    .popup__header-bar--with-icon {
        grid-template-columns: auto 1fr;
        align-items: flex-start;
        gap: 0.65rem;
    }
    .popup__header-icon {
        grid-column: 1;
        grid-row: 1 / span 2;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 2.75rem;
        height: 2.75rem;
        border-radius: 10px;
        background: color-mix(in srgb, var(--status-color, #007a52) 8%, #fff);
        border: 1px solid color-mix(in srgb, var(--status-color, #007a52) 28%, #e8eef4);
        box-shadow: 0 2px 6px rgba(15, 23, 42, 0.08);
    }
    .popup__header-icon .popup__type-icon {
        width: 1.75rem;
        height: 1.75rem;
    }
    .popup__header-text {
        grid-column: 2;
        min-width: 0;
        min-height: 48px;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 0.35rem;
    }
    .popup__title {
        margin: 0 !important;
        padding: 0 !important;
        min-width: 0;
        font-size: 1.0625rem !important;
        font-weight: 700 !important;
        line-height: 1.25 !important;
        color: #17324d;
    }
    .leaflet-popup.popup-wrapper .popup__title {
        color: #17324d !important;
    }
    .popup__address-preview {
        margin: 0;
        font-size: 0.8125rem;
        line-height: 1.35;
        color: #5c6f82;
        font-weight: 500;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .popup__header-bar .popup__status {
        justify-self: start;
    }
    .popup__code {
        font-family: ui-monospace, 'Cascadia Code', 'Source Code Pro', monospace;
        font-size: 0.875rem;
        letter-spacing: 0.02em;
        color: #5c6f82;
    }
    .popup__status {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        padding: 0.25rem 0.65rem 0.25rem 0.45rem;
        border-radius: 999px;
        background: color-mix(in srgb, var(--status-color, #607d8b) 18%, #fff);
        border: 1px solid color-mix(in srgb, var(--status-color, #607d8b) 45%, #fff);
        font-size: 0.8rem;
        font-weight: 700;
        color: #17324d;
        box-shadow: 0 1px 2px rgba(15, 23, 42, 0.1);
    }
    .popup__status-dot {
        width: 11px;
        height: 11px;
        border-radius: 50%;
        background: var(--status-color, #607d8b);
        border: 1.5px solid #fff;
        box-shadow: 0 0 0 1px rgba(23, 50, 77, 0.15);
        flex-shrink: 0;
    }
    .popup__body {
        padding: 0;
        margin: 0;
        max-height: min(26vh, 160px);
        overflow-y: auto;
        overflow-x: hidden;
        position: relative;
        z-index: 1;
        flex: 0 0 auto;
    }
    .popup {
        display: block;
        height: auto;
    }
    .popup__row {
        padding: 0.2rem 1rem 0.4rem;
        border-bottom: 1px solid #eef2f6;
    }
    .popup__row:last-child {
        border-bottom: none;
    }
    .popup__row--type {
        padding-top: 0.2rem;
        padding-bottom: 0.35rem;
        margin-top: 0 !important;
    }
    .popup__row-label {
        display: block;
        font-size: 0.6875rem;
        font-weight: 700;
        letter-spacing: 0.04em;
        text-transform: uppercase;
        color: #5c6f82;
        margin: 0 0 0.05rem;
        line-height: 1.2;
    }
    .popup__row-value {
        margin: 0;
        font-size: 0.9375rem;
        line-height: 1.35;
        color: #17324d;
        word-break: break-word;
        overflow-wrap: anywhere;
        font-weight: 600;
    }
    .popup__type-value {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        font-weight: 600;
    }
    .popup__type-value .popup__type-icon {
        width: 22px;
        height: 22px;
        flex: 0 0 22px;
    }
    .popup__type-icon {
        flex: 0 0 auto;
        object-fit: contain;
    }
    .popup__map-links {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-top: 0.25rem;
    }
    .popup__map-link {
        font-size: 0.875rem;
        font-weight: 600;
        color: #007a52;
        text-decoration: none;
        padding: 0.35rem 0.7rem;
        border-radius: 7px;
        background: #f0faf6;
        border: 1px solid #d8f3e7;
        transition: all 0.2s ease;
    }
    .popup__map-link:hover {
        background: #d8f3e7;
        text-decoration: underline;
        transform: translateY(-1px);
    }
    .popup__description {
        margin: 0.25rem 1rem 0.85rem;
        padding: 0.65rem 0.85rem;
        font-size: 0.9375rem;
        line-height: 1.5;
        color: #334155;
        background: color-mix(in srgb, var(--status-color, #607d8b) 6%, #fff);
        border-radius: 8px;
        display: -webkit-box;
        -webkit-line-clamp: 4;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .popup__gallery {
        display: flex;
        flex-direction: row;
        gap: 0.6rem;
        padding: 0 1.25rem 0.85rem;
        overflow-x: auto;
        scroll-snap-type: x mandatory;
        -webkit-overflow-scrolling: touch;
    }
    .popup__img {
        flex: 0 0 78%;
        width: 78%;
        max-width: 300px;
        height: 150px;
        object-fit: cover;
        border-radius: 10px;
        display: block;
        scroll-snap-align: start;
        border: 1px solid rgba(15, 23, 42, 0.08);
        box-shadow: 0 2px 8px rgba(15, 23, 42, 0.12);
    }
    .popup__skeleton {
        border-radius: 6px;
        background: linear-gradient(90deg, #eef2f6 0%, #f8fafc 50%, #eef2f6 100%);
        background-size: 200% 100%;
        animation: popup-shimmer 1.2s ease-in-out infinite;
    }
    .popup__skeleton--title {
        height: 1.1rem;
        width: 75%;
        margin: 0;
        flex: 1 1 auto;
        min-width: 0;
    }
    .popup__skeleton--line {
        height: 0.9rem;
        width: 100%;
        margin: 0.6rem 1.25rem;
    }
    .popup__skeleton--short {
        width: 60%;
    }
    @keyframes popup-shimmer {
        0% { background-position: 100% 0; }
        100% { background-position: -100% 0; }
    }
    .popup__footer {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        padding: 0.75rem 1rem 0.9rem;
        border-top: 1px solid #e8eef4;
        background: #f8fafc;
        position: relative;
        z-index: 1;
    }
    .leaflet-popup.popup-wrapper .popup__footer {
        background: #f8fafc !important;
    }
    .popup__link {
        flex: 1 1 auto;
        width: 100%;
        min-width: 0;
        padding: 0.6rem 1rem;
        font-size: 0.9rem;
        font-weight: 600;
        font-family: inherit;
        border-radius: 9px;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
        line-height: 1.25;
        border: none;
        transition: all 0.2s ease;
    }
    .popup__link--primary {
        color: #fff;
        background: #007a52;
        box-shadow: 0 2px 8px rgba(0, 122, 82, 0.3);
        min-height: 48px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .leaflet-popup.popup-wrapper .popup__link--primary {
        color: #fff !important;
        background: #007a52 !important;
    }
    .popup__link--primary:hover {
        background: #006341;
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 122, 82, 0.35);
    }
    .popup__link--ghost {
        color: #007a52;
        background: #fff;
        border: 2px solid #007a52;
        min-height: 48px;
    }
    .leaflet-popup.popup-wrapper .popup__link--ghost {
        color: #007a52 !important;
        background: #fff !important;
    }
    .popup__link--ghost:hover {
        background: #f0faf6;
        transform: translateY(-1px);
    }
    .popup__link--primary:focus-visible,
    .popup__link--ghost:focus-visible {
        outline: 3px solid #17324d;
        outline-offset: 3px;
    }
    @media (max-width: 900px) {
        .leaflet-popup.popup-wrapper .leaflet-popup-content {
            max-height: min(260px, 65vh) !important;
            overflow: hidden;
        }
        .popup {
            display: flex;
            flex-direction: column;
            max-height: min(260px, 65vh);
        }
        .popup__header,
        .popup__footer {
            flex: 0 0 auto;
        }
        .popup__body {
            flex: 1 1 auto;
            min-height: 0;
            max-height: none;
            overflow-y: auto;
        }
        .popup__links-block,
        .popup__hero,
        .popup__gallery {
            display: none;
        }
        .popup__description {
            -webkit-line-clamp: 2;
        }
        .popup__footer {
            gap: 0.35rem;
            padding: 0.4rem 0.65rem;
        }
        .popup__link {
            min-height: 44px;
            padding: 0.55rem 0.75rem;
        }
    }

    /* UX 2026-10-07: popup compatto, mai piu largo della mappa, un solo indirizzo, pulsanti affiancati. */
    .leaflet-popup.popup-wrapper .leaflet-popup-content {
        width: min(360px, calc(100vw - 3rem)) !important;
        max-width: none;
    }
    .leaflet-popup.popup-wrapper .popup__address-preview {
        display: none;
    }
    .leaflet-popup.popup-wrapper .popup__body {
        max-height: min(34vh, 230px);
    }
    .leaflet-popup.popup-wrapper .popup__description {
        display: block;
        -webkit-line-clamp: unset;
        overflow: visible;
        color: #17324d;
    }
    .leaflet-popup.popup-wrapper .popup__footer {
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        align-items: stretch;
        gap: 0.5rem;
        padding: 0.6rem 0.75rem;
    }
    .leaflet-popup.popup-wrapper .popup__link {
        width: auto;
        min-height: 44px;
        text-decoration: none !important;
    }
    .leaflet-popup.popup-wrapper .popup__link--primary {
        flex: 1 1 60%;
    }
    .leaflet-popup.popup-wrapper .popup__link--ghost {
        flex: 0 0 auto;
        padding-inline: 1.1rem;
    }
    .leaflet-popup.popup-wrapper .popup__header-bar {
        padding-right: 2.25rem;
    }
    /* la regola base con !important metteva l'icona nella colonna 1fr (180px): variante con icona piu specifica */
    .leaflet-popup.popup-wrapper .popup__header-bar.popup__header-bar--with-icon {
        grid-template-columns: 2.75rem minmax(0, 1fr) !important;
        column-gap: 0.75rem;
    }
    .leaflet-popup.popup-wrapper .popup__header-text {
        align-items: flex-start;
        justify-content: flex-start;
        text-align: left;
        min-width: 0;
    }
    .leaflet-popup.popup-wrapper .popup__title {
        text-align: left;
    }
    /* Mobile: la mappa lascia 56px ai controlli a sinistra (autoPan) e 16px a destra */
    @media (max-width: 640px) {
        .leaflet-popup.popup-wrapper .leaflet-popup-content {
            width: calc(100vw - 6.75rem) !important;
        }
    }
    @media (max-width: 900px) {
        .leaflet-popup.popup-wrapper .leaflet-popup-content {
            max-height: min(250px, 58vh) !important;
        }
        .leaflet-popup.popup-wrapper .popup {
            max-height: min(250px, 58vh);
        }
    }
`;window.L=E;globalThis.L=E;const $o=(function(){const s=[window.L&&window.L.MarkerClusterGroup,window.L&&window.L.markerClusterGroup&&window.L.markerClusterGroup.prototype&&window.L.MarkerClusterGroup,E.MarkerClusterGroup];for(const r of s)if(typeof r=="function")return r;return null})();$o&&!E.markerClusterGroup&&(E.markerClusterGroup=s=>new $o(s));const Di="/data/tickets.json",xl=[41.9028,12.4964],kl=6,rr="clamp(360px, 58vh, 560px)";function Ll(s){const r=String(s||"").trim();return r===""||r==="100%"||r==="auto"?rr:r}function Fi(s){if(s==null||String(s).trim()==="")return null;const r=Number.parseFloat(String(s));return Number.isFinite(r)?r:null}class sr extends ke{createRenderRoot(){return this}constructor(){super(),this.filterType=null,this.activeLayer="markers",this.isFullscreen=!1,this._searchOpen=!1,this.searchQuery="",this.searchResults=[],this.showSearchResults=!1,this.isSearching=!1,this.isLocating=!1,this._previousBodyOverflow="",this._previousHtmlOverflow="",this._geolocRequested=!1,this.labels=Go(),this.height=rr,this.dataUrl=Di,this.lat=null,this.lng=null,this.detailMode=!1,this.ticketId=null,this._currentLayer="street",this._allFeatures=[],this._allMarkers=[],this._layers={},this._isUserCentered=!1,this._initialFitDone=!1,this._activeTypeFilter=null,this._activeStatusFilter=null,this._geojsonLayer=null,this._invalidateSizeTimer=null,this._filterRenderTimer=null,this._mapReady=!1,this._mutationDebounceTimer=null,this._legendControl=null}render(){return $`
            <style>
                ${rl}
                map-lit { display: block; width: 100%; min-height: 320px; }
                .geo-map-leaflet { width: 100%; height: 100%; min-height: 320px; }
                ${ml}
                .leaflet-div-icon { background: transparent !important; border: none !important; }
                ${Oo}

                html.geo-map-fullscreen-active, html.geo-map-fullscreen-active body { overflow: hidden !important; }
            </style>
            <div class="map-container ${this.isFullscreen?"is-fullscreen":""}"
                 style="position:relative;--map-height:${Ll(this.height)};">
                <div class="geo-map-leaflet" style="width:100%;height:100%;"></div>
                ${this.detailMode?"":il(this)}
                ${!this.detailMode&&this._searchOpen?Xa(this,Qo):""}
            </div>
        `}_toggleFullscreen(){Fo(this)}_switchLayer(){jo(this)}_zoomIn(){Uo(this)}_zoomOut(){Wo(this)}_requestGeolocation(){Vo(this,{showLoading:!0})}connectedCallback(){super.connectedCallback(),this.dataUrl=this.getAttribute("data-url")||this.dataUrl||Di,this.lat=Fi(this.getAttribute("lat")),this.lng=Fi(this.getAttribute("lng")),this.detailMode=this.hasAttribute("detail-mode"),this.ticketId=Fi(this.getAttribute("ticket-id"))}_hasExplicitCenter(){return Number.isFinite(this.lat)&&Number.isFinite(this.lng)}async firstUpdated(){super.firstUpdated(),await this.updateComplete,this._onFiltersChanged=r=>{const a=r.detail??{};Array.isArray(a.types)&&(this._activeTypeFilter=a.types.length>0?a.types:null),Array.isArray(a.statuses)&&(this._activeStatusFilter=a.statuses.length>0?a.statuses:null),this._applyFeatureFilters()},this.addEventListener("filters-changed",this._onFiltersChanged);try{await this._initMap()}catch(r){console.error("[map-lit] Map init failed:",r)}}async _initMap(){const r=this.renderRoot.querySelector(".geo-map-leaflet");if(!r){console.warn("[map-lit] .geo-map-leaflet container missing");return}if(!document.getElementById("popup-styles")){const h=document.createElement("style");h.id="popup-styles",h.textContent=Oo,document.head.appendChild(h)}await this._ensureLeafletPlugins(),this._map=E.map(r,{center:xl,zoom:kl,minZoom:this.detailMode?14:3,maxZoom:this.detailMode?18:19,zoomControl:!1,zoomAnimation:!1,dragging:!this.detailMode,scrollWheelZoom:!this.detailMode,doubleClickZoom:!this.detailMode,touchZoom:!this.detailMode}),this._layers=nl(E),this._layers[this._currentLayer].addTo(this._map),E.control.scale({imperial:!1}).addTo(this._map);const a=E.markerClusterGroup||window.L&&window.L.markerClusterGroup;console.log("[map-lit] clusterFactory available:",typeof a=="function",E.MarkerClusterGroup),typeof a=="function"?(this._markersLayer=a({maxClusterRadius:h=>h<12?80:45,spiderfyOnMaxZoom:!0,showCoverageOnHover:!1,zoomToBoundsOnClick:!0,chunkedLoading:!0,removeOutsideVisibleBounds:!1,animate:!1,animateAddingMarkers:!1,iconCreateFunction:h=>this._createClusterIcon(h)}),this._map.addLayer(this._markersLayer)):this._markersLayer=E.layerGroup().addTo(this._map),this._map.on("popupopen",h=>{const u=this._map.getContainer(),p=u.clientWidth,f=u.clientHeight;h.popup.options.maxWidth=Math.floor(p*.95),h.popup.options.maxHeight=Math.floor(f*.65),h.popup.update(),this._wirePopupActions(h.popup)}),this._map.on("zoomend",()=>{typeof this._markersLayer?.refreshClusters=="function"&&this._markersLayer.refreshClusters()}),this._setupMutationObserver(),this._setupVisibilityObserver(),this._syncMapLegend([]),this._loadGeoJson()}async _ensureLeafletPlugins(){window.L=E,globalThis.L=E,await this._waitForMarkerCluster(),await Rs(()=>import("./leaflet-heat-hQeRTJ38.js"),[]).catch(r=>console.warn("[map-lit] Heat plugin unavailable:",r.message))}async _waitForMarkerCluster(){for(let a=0;a<50;a++){if((E.markerClusterGroup||E.MarkerClusterGroup&&!E.markerClusterGroup)&&(!E.markerClusterGroup&&E.MarkerClusterGroup&&(E.markerClusterGroup=h=>new E.MarkerClusterGroup(h)),E.markerClusterGroup)){console.log("[map-lit] markerCluster ready after",a*50,"ms");return}await new Promise(h=>setTimeout(h,50))}console.warn("[map-lit] markerCluster not available after",2500,"ms")}_setupMutationObserver(){this._mutationObserver=new MutationObserver(()=>{this.offsetParent===null||!this._map||(this._mutationDebounceTimer&&clearTimeout(this._mutationDebounceTimer),this._mutationDebounceTimer=setTimeout(()=>{this._mutationDebounceTimer=null,this.refreshWhenVisible()},200))});let r=this.parentElement;for(let a=0;a<12&&r;a++)this._mutationObserver.observe(r,{attributes:!0,attributeFilter:["class","style","hidden"]}),r=r.parentElement;document.addEventListener("shown.bs.tab",a=>{if(!this._map)return;const h=String(a.target?.getAttribute?.("data-bs-target")||a.target?.getAttribute?.("href")||"");(h.includes("map")||h.includes("mappa")||h.includes("tab-mappa")||this.offsetParent!==null)&&setTimeout(()=>{if(this._map.invalidateSize({pan:!1,animate:!1}),this._allFeatures?.length&&this._initialFitDone){const p=this._resolveFilteredFeatures();p.length&&this._fitBoundsToMarkers(p)}},80)})}_setupVisibilityObserver(){typeof IntersectionObserver>"u"||(this._visibilityObserver?.disconnect(),this._visibilityObserver=new IntersectionObserver(r=>{for(const a of r)!a.isIntersecting||a.intersectionRatio<=0||this.refreshWhenVisible()},{root:null,threshold:[0,.12,.35]}),this._visibilityObserver.observe(this))}_createClusterIcon(r){const a=r.getAllChildMarkers(),h=a.length,u=this._map?this._map.getZoom():0,p=E.point(40,40),f=E.point(80,80);if(u>=8){const v=new Map;a.forEach(b=>{const k=b.options.typeValue;!k||v.has(k)||v.set(k,{iconUrl:b.options.typeIconUrl,label:b.options.typeLabel})});const _=[...v.values()].slice(0,4).map(b=>ll(b.iconUrl,b.label,16)).join("");return E.divIcon({html:`<div class="geo-cluster-circle"><strong>${h}</strong><div class="geo-cluster-type-icons">${_}</div></div>`,className:"geo-cluster-wrapper",iconSize:f,iconAnchor:p})}return E.divIcon({html:`<div class="geo-cluster-circle"><strong>${h}</strong></div>`,className:"geo-cluster-wrapper",iconSize:f,iconAnchor:p})}_filterFeaturesForDetailMode(r){if(!this.detailMode||!Number.isFinite(this.ticketId))return r;const a=String(this.ticketId);return r.filter(h=>String((h.properties||{}).id??"")===a)}_loadGeoJson(){const r=this.dataUrl||Di;console.log("[map-lit] Loading GeoJSON from:",r),fetch(r).then(a=>a.json()).then(a=>{if(console.log("[map-lit] GeoJSON loaded:",a?.features?.length||0,"features"),!a||!Array.isArray(a.features)){console.error("[map-lit] Invalid GeoJSON:",a);return}const h=a.features.filter(f=>f.geometry&&Array.isArray(f.geometry.coordinates)&&f.geometry.coordinates.length>=2&&!isNaN(parseFloat(f.geometry.coordinates[0]))&&!isNaN(parseFloat(f.geometry.coordinates[1]))),u=this._filterFeaturesForDetailMode(h);this._allFeatures=u,console.log("[map-lit] Valid features:",u.length),this.detailMode||this._syncMapLegend(u);const p=this._resolveFilteredFeatures();this._renderMarkersFromFeatures(p),this._mapReady=!0,this._initialFitDone?this.refreshWhenVisible():(this._initialFitDone=!0,setTimeout(()=>this.refreshWhenVisible(()=>{if(!this._hasExplicitCenter()&&navigator.geolocation)this._tryCenterOnGpsThenMarkers(p);else if(this._hasExplicitCenter()){const f=this.detailMode?16:14;this._map.setView([this.lat,this.lng],f,{animate:!1})}else this._fitBoundsToMarkers(p)}),350)),this.dispatchEvent(new CustomEvent("geo-map-loaded",{detail:{count:this._allFeatures.length,types:[...new Set(this._allFeatures.map(f=>Xe(f.properties||{}).value).filter(Boolean))]},bubbles:!0,composed:!0}))}).catch(a=>console.error("[map-lit] Error loading GeoJSON from",r,a))}filterByType(r){if(Array.isArray(r)){this.filterByTypes(r);return}this.filterByTypes(r?[r]:null)}_resolveFilteredFeatures(r=this._activeTypeFilter,a=this._activeStatusFilter){const h=Array.isArray(r)?r.filter(v=>typeof v=="string"&&v.length>0):[],u=Array.isArray(a)?a.filter(v=>typeof v=="string"&&v.length>0):[],p=h.length>0?new Set(h):null,f=u.length>0?new Set(u):null;return p===null&&f===null?this._allFeatures:this._allFeatures.filter(v=>{const _=v.properties||{};if(p!==null){const b=Xe(_);if(!p.has(b.value))return!1}if(f!==null){const b=Ri(_);if(!f.has(b.value))return!1}return!0})}_clearMarkersLayer(){this._markersLayer&&(typeof this._markersLayer.clearLayers=="function"&&this._markersLayer.clearLayers(),this._geojsonLayer=null)}_renderMarkersFromFeatures(r){if(!this._markersLayer||!Array.isArray(r)||(this._allMarkers=[],this._clearMarkersLayer(),r.length===0))return;const a=[];r.forEach(h=>{const u=h.geometry?.coordinates;if(!Array.isArray(u)||u.length<2)return;const p=Number.parseFloat(String(u[0])),f=Number.parseFloat(String(u[1]));if(!Number.isFinite(f)||!Number.isFinite(p))return;const v=E.latLng(f,p),_=h.properties||{},b=Xe(_),k=Ri(_),y=[String(_.title||_.name||b.label||"").trim(),String(k.label||"").trim()].filter(Boolean).join(" — "),S=E.marker(v,{icon:fl(E,k.color,b.iconUrl,b.label),title:y,alt:y,keyboard:!0,typeValue:b.value,typeLabel:b.label,typeIconUrl:b.iconUrl,statusValue:k.value,statusColor:k.color,statusLabel:k.label});S.feature=h,this.detailMode||this._bindFeaturePopup(h,S),a.push(S)}),this._allMarkers=a,typeof this._markersLayer.addLayers=="function"?this._markersLayer.addLayers(a):a.forEach(h=>this._markersLayer.addLayer(h)),console.log("[map-lit] Rendered",this._allMarkers.length,"markers to cluster layer")}_openTicketModal(r,a,h=null){const u=document.getElementById("modal-disservizio");if(!u){console.warn("[map-lit] Modal #modal-disservizio not found in DOM");return}const p=h?.title||r.title||r.name||"",f=a.label||"",v=String(r.address||"").trim(),_=String(r.city||"").trim(),b=v&&_&&!v.toLowerCase().includes(_.toLowerCase())?`${v} - ${_}`:v||_||"—",k=h?.description||r.description||r.content||"",y=(O,pt)=>{const Ht=u.querySelector(O);Ht&&(Ht.textContent=pt||"—")},S=u.querySelector("#modal2Title");S&&(S.textContent=p||"—"),y('[data-element="modal-ticket-title"]',p),y('[data-element="modal-ticket-type"]',f),y('[data-element="modal-ticket-address"]',b),y('[data-element="modal-ticket-detail"]',k);const R=Array.isArray(h?.images)?h.images:Array.isArray(r.images)?r.images:[],W=u.querySelector(".modal-body img");W&&(W.src=R[0]||"/themes/Sixteen/design-comuni/assets/images/img-disservizio-thumbnail.png");try{const O=window.bootstrap?.Modal;if(O)new O(u).show();else if(u.classList.add("show"),u.style.display="block",u.setAttribute("aria-hidden","false"),document.body.classList.add("modal-open"),!document.querySelector(".modal-backdrop.fade.show")){const pt=document.createElement("div");pt.className="modal-backdrop fade show",document.body.appendChild(pt)}}catch(O){console.error("[map-lit] Failed to open #modal-disservizio:",O)}}_wirePopupActions(r){const a=r?.getElement?.();if(!a)return;const h=a.querySelector("[data-popup-close]");h&&!h.dataset.geoWired&&(h.dataset.geoWired="1",h.addEventListener("click",p=>{p.preventDefault(),this._map?.closePopup()}));const u=a.querySelector("[data-popup-open-detail]");u&&!u.dataset.geoWired&&(u.dataset.geoWired="1",u.addEventListener("click",p=>{p.preventDefault();const f=r._geoFeatureProps,v=r._geoTicketType;r._geoTicketStatus;const _=r._geoTicketDetail;f&&v&&this._openTicketModal(f,v,_),this._map?.closePopup()}))}_ensureFeaturePopup(r){let a=r.getPopup?.();return a||(a=E.popup({className:"popup-wrapper",maxWidth:420,minWidth:300,autoPanPaddingTopLeft:E.point(72,16),autoPanPaddingBottomRight:E.point(24,96)}),r.bindPopup(a)),a}_openFeaturePopupLoading(r,a,h){const u=this._ensureFeaturePopup(r);u.setContent(Ni(a,h)),u._geoFeatureProps=null,u._geoTicketType=a,u._geoTicketStatus=h,u._geoTicketDetail=null,r.openPopup()}_openFeaturePopup(r,a,h,u,p=null,f={}){const v=Eo(a,h,u,p,f),_=this._ensureFeaturePopup(r);_.setContent(v),_._geoFeatureProps=a,_._geoTicketType=h,_._geoTicketStatus=u,_._geoTicketDetail=p,r.openPopup(),this._wirePopupActions(_)}_bindFeaturePopup(r,a){const h=r.properties||{},u=Xe(h),p=Ri(h),f=r.geometry?.coordinates,v=Number(f?.[0]),b={lat:Number(f?.[1]),lng:v};a.bindPopup(Ni(u,p),{className:"popup-wrapper",maxWidth:380,minWidth:300,autoPanPaddingTopLeft:E.point(72,16),autoPanPaddingBottomRight:E.point(24,96)}),a.on("click",k=>{k?.originalEvent&&E.DomEvent.stopPropagation(k);const y=this._ensureFeaturePopup(a),S=R=>{R&&(a._geoDetailCache=R);const W=Eo(h,u,p,R,b);y.setContent(W),y._geoFeatureProps=h,y._geoTicketType=u,y._geoTicketStatus=p,y._geoTicketDetail=R,y.update(),this._wirePopupActions(y)};if(a._geoDetailCache){S(a._geoDetailCache);return}h.id?(y.setContent(Ni(u,p)),y._geoFeatureProps=null,y.update(),fetch(`/api/ticket-details/${h.id}`).then(R=>R.ok?R.json():null).then(R=>S(R)).catch(()=>S(null))):S(null)})}_fitBoundsToMarkers(r,a=null){if(!(!this._map||!this._markersLayer||!r?.length))try{this._map.invalidateSize({pan:!1,animate:!1});const h=this._map.getPanes?.()?.mapPane,u=this._map.getContainer?.();h&&u&&h.offsetWidth===0&&u.offsetWidth>0&&(h.style.width=u.offsetWidth+"px",h.style.height=u.offsetHeight+"px",this._map.invalidateSize({pan:!1,animate:!1}),console.log("[map-lit] mapPane size forced:",u.offsetWidth,"x",u.offsetHeight)),this._map._pixelOrigin||this._map._resetView(this._map.getCenter(),this._map.getZoom(),!0);const p=this._markersLayer.getBounds?.(),f=p?.isValid?.()?null:this._markersLayer._featureGroup?.getBounds?.();let v=p?.isValid?.()?p:f?.isValid?.()?f:null;if(a&&Number.isFinite(a.lat)&&Number.isFinite(a.lng)){const b=E.latLng(a.lat,a.lng);v=v?v.extend(b):E.latLngBounds(b,b)}if(!v?.isValid?.()){console.warn("[map-lit] fitBounds: bounds not valid");return}const _=r.length<=3?14:r.length<=15?13:r.length<=40?12:11;this._map.fitBounds(v,{padding:[40,40],maxZoom:_,animate:!1}),console.log("[map-lit] fitBounds OK zoom:",this._map.getZoom(),"n:",r.length)}catch(h){console.warn("[map-lit] fitBounds skipped:",h.message)}}_tryCenterOnGpsThenMarkers(r){if(!navigator.geolocation){this._fitBoundsToMarkers(r);return}let a=!1;const h=p=>{a||(a=!0,p())},u=setTimeout(()=>{h(()=>this._fitBoundsToMarkers(r))},5e3);navigator.geolocation.getCurrentPosition(p=>{clearTimeout(u);const f=p.coords.latitude,v=p.coords.longitude;this._isUserCentered=!0,this._geolocRequested=!0;const _=E.latLng(f,v);h(()=>{this._map.setView(_,14,{animate:!1});const b=this._markersLayer?.getBounds?.();b?.isValid?.()&&b.contains(_)&&this._fitBoundsToMarkers(r,_)})},()=>{clearTimeout(u),h(()=>this._fitBoundsToMarkers(r))},{enableHighAccuracy:!1,timeout:5e3,maximumAge:6e4})}refreshWhenVisible(r=null){!this._map||this.offsetParent===null||(this._invalidateSizeTimer&&clearTimeout(this._invalidateSizeTimer),this._invalidateSizeTimer=setTimeout(()=>{this._invalidateSizeTimer=null,!(!this._map||this.offsetParent===null)&&(this._map.invalidateSize({pan:!1}),typeof r=="function"&&r())},80))}invalidateSize(){this.refreshWhenVisible()}_syncMapLegend(r){const a=this.getAttribute("legend-mode")||"off";if(a==="off"||a==="sidebar"){this._legendControl&&(this._map.removeControl(this._legendControl),this._legendControl=null);return}}filterByTypes(r){this._activeTypeFilter=Array.isArray(r)&&r.length>0?r:null,this._applyFeatureFilters()}filterByStatuses(r){this._activeStatusFilter=Array.isArray(r)&&r.length>0?r:null,this._applyFeatureFilters()}_applyFeatureFilters(){!this._markersLayer||this._allFeatures.length===0||(this._filterRenderTimer&&clearTimeout(this._filterRenderTimer),this._filterRenderTimer=setTimeout(()=>{this._filterRenderTimer=null;const r=this._resolveFilteredFeatures();this._syncMapLegend(r),this._renderMarkersFromFeatures(r)},80))}disconnectedCallback(){super.disconnectedCallback(),this._onFiltersChanged&&this.removeEventListener("filters-changed",this._onFiltersChanged),this._mutationObserver?.disconnect(),this._visibilityObserver?.disconnect(),this._legendControl=null,this._map&&(this._map.remove(),this._map=null)}}uo(sr,"properties",{filterType:{type:String},activeLayer:{type:String},isFullscreen:{type:Boolean,state:!0},height:{type:String},_searchOpen:{type:Boolean,state:!0},labels:{type:Object},dataUrl:{type:String,attribute:"data-url"},lat:{type:Number,attribute:"lat"},lng:{type:Number,attribute:"lng"},detailMode:{type:Boolean,attribute:"detail-mode"},ticketId:{type:Number,attribute:"ticket-id"},searchQuery:{type:String,state:!0},searchResults:{type:Array,state:!0},showSearchResults:{type:Boolean,state:!0},isSearching:{type:Boolean,state:!0},isLocating:{type:Boolean,state:!0}});customElements.get("map-lit")||customElements.define("map-lit",sr);export{Dt as E,E as L,fa as a,$ as b,nl as c,fl as d,pa as e,Xa as f,il as g,zl as h,ke as i,Jo as j,jo as k,Wo as l,rl as m,Vo as r,Qo as s,Fo as t,Uo as z};
