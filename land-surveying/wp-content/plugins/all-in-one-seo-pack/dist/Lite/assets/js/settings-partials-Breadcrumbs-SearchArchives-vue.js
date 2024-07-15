(window["aioseopjsonp"]=window["aioseopjsonp"]||[]).push([["settings-partials-Breadcrumbs-SearchArchives-vue","settings-partials-Breadcrumbs-Preview-vue"],{"2dbb":function(e,r,a){"use strict";a.r(r);var s=function(){var e=this,r=e.$createElement,a=e._self._c||r;return a("core-settings-row",{key:"Search",attrs:{name:"Search"},scopedSlots:e._u([{key:"content",fn:function(){return[a("div",[a("preview",{attrs:{"preview-data":e.getPreview(),useDefaultTemplate:e.options.breadcrumbs.dynamic.archives.search.useDefaultTemplate}}),a("grid-row",[a("grid-column",[a("base-toggle",{staticClass:"current-item",model:{value:e.options.breadcrumbs.dynamic.archives.search.useDefaultTemplate,callback:function(r){e.$set(e.options.breadcrumbs.dynamic.archives.search,"useDefaultTemplate",r)},expression:"options.breadcrumbs.dynamic.archives.search.useDefaultTemplate"}}),e._v(" "+e._s(e.strings.useDefaultTemplate)+" ")],1)],1),e.options.breadcrumbs.dynamic.archives.search.useDefaultTemplate?e._e():a("grid-row",[e.options.breadcrumbs.breadcrumbPrefix&&e.options.breadcrumbs.breadcrumbPrefix.length?a("grid-column",[a("base-toggle",{staticClass:"current-item",model:{value:e.options.breadcrumbs.dynamic.archives.search.showPrefixCrumb,callback:function(r){e.$set(e.options.breadcrumbs.dynamic.archives.search,"showPrefixCrumb",r)},expression:"options.breadcrumbs.dynamic.archives.search.showPrefixCrumb"}}),e._v(" "+e._s(e.strings.showPrefixLabel)+" ")],1):e._e(),a("grid-column",[a("base-toggle",{staticClass:"current-item",model:{value:e.options.breadcrumbs.dynamic.archives.search.showHomeCrumb,callback:function(r){e.$set(e.options.breadcrumbs.dynamic.archives.search,"showHomeCrumb",r)},expression:"options.breadcrumbs.dynamic.archives.search.showHomeCrumb"}}),e._v(" "+e._s(e.strings.showHomeLabel)+" ")],1),a("grid-column",[a("core-html-tags-editor",{attrs:{"line-numbers":!0,checkUnfilteredHtml:"","tags-context":"breadcrumbs-search","minimum-line-numbers":3,"default-tags":["breadcrumb_search_result_format","breadcrumb_search_string","breadcrumb_link"]},model:{value:e.options.breadcrumbs.dynamic.archives.search.template,callback:function(r){e.$set(e.options.breadcrumbs.dynamic.archives.search,"template",r)},expression:"options.breadcrumbs.dynamic.archives.search.template"}})],1)],1)],1)]},proxy:!0}])})},t=[],i=a("5530"),c=(a("ac1f"),a("841c"),a("5319"),a("2f62")),n=a("c468"),o={components:{preview:n["default"]},data:function(){return{strings:{useDefaultTemplate:this.$t.__("Use a default template",this.$td),showHomeLabel:this.$t.__("Show homepage link",this.$td),showPrefixLabel:this.$t.__("Show prefix link",this.$td),searchString:this.$t.__("search term",this.$td)}}},methods:{getPreview:function(){var e=this.options.breadcrumbs,r=e.dynamic.archives.search,a=r.useDefaultTemplate;return[a&&e.breadcrumbPrefix||!a&&r.showPrefixCrumb?e.breadcrumbPrefix:"",a&&e.homepageLink||!a&&r.showHomeCrumb?e.homepageLabel?e.homepageLabel:"Home":"",this.getTemplate()]},getTemplate:function(){var e=this.options.breadcrumbs.dynamic.archives.search.useDefaultTemplate?this.$aioseo.breadcrumbs.defaultTemplates.archives.search:this.options.breadcrumbs.dynamic.archives.search.template;return e.replace(/#breadcrumb_search_result_format/g,this.options.breadcrumbs.searchResultFormat).replace(/#breadcrumb_search_string/g,this.strings.searchString)}},computed:Object(i["a"])({},Object(c["e"])(["options"]))},u=o,m=a("2877"),l=Object(m["a"])(u,s,t,!1,null,null,null);r["default"]=l.exports},c468:function(e,r,a){"use strict";a.r(r);var s=function(){var e=this,r=e.$createElement,a=e._self._c||r;return a("div",{staticClass:"preview-box"},[e.label?a("span",{staticClass:"label"},[e._v(" "+e._s(e.label)+": ")]):e._e(),e._l(this.getPreviewData(),(function(r,s){return[1<e.previewLength&&s>0&&s<e.previewLength?a("span",{key:s+"sep",staticClass:"aioseo-breadcrumb-separator",domProps:{innerHTML:e._s(e.options.breadcrumbs.separator)}}):e._e(),s<e.previewLength-1?a("span",{key:s+"crumb",class:{"aioseo-breadcrumb":!r.match(/aioseo-breadcrumb/),link:r!==e.options.breadcrumbs.breadcrumbPrefix&&!r.match(/<a /)},domProps:{innerHTML:e._s(r)}}):e._e(),s===e.previewLength-1?a("span",{key:s+"crumbLast",class:{last:!0,link:e.options.breadcrumbs.linkCurrentItem&&e.useDefaultTemplate&&!r.match(/<a /),noLink:!e.options.breadcrumbs.linkCurrentItem&&e.useDefaultTemplate,"aioseo-breadcrumb":!r.match(/aioseo-breadcrumb/)},domProps:{innerHTML:e._s(r)}}):e._e()]}))],2)},t=[],i=a("5530"),c=(a("d81d"),a("4de4"),a("ac1f"),a("5319"),a("fb6a"),a("2f62")),n={props:{previewData:{type:Array,default:null},useDefaultTemplate:{type:Boolean,default:!0},label:String},computed:Object(i["a"])(Object(i["a"])({},Object(c["e"])(["options"])),{},{previewLength:function(){return this.getPreviewData()?this.getPreviewData().length:0}}),methods:{getPreviewData:function(){var e=this,r=this.previewData.filter((function(e){return!!e})).map((function(r){return e.$tags.decodeHTMLEntities(r).replace(/#breadcrumb_separator/g,'<span class="aioseo-breadcrumb-separator">'+e.options.breadcrumbs.separator+"</span>").replace(/#breadcrumb_link/g,"Permalink")}));return this.useDefaultTemplate&&!this.options.breadcrumbs.showCurrentItem&&(r=r.slice(0,r.length-1)),r}}},o=n,u=a("2877"),m=Object(u["a"])(o,s,t,!1,null,null,null);r["default"]=m.exports}}]);