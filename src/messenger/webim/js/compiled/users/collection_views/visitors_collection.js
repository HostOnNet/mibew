/*
 Copyright 2005-2013 the original author or authors.

 Licensed under the Apache License, Version 2.0 (the "License").
 You may obtain a copy of the License at
     http://www.apache.org/licenses/LICENSE-2.0
*/
(function(a,b,c){a.Views.VisitorsCollection=a.Views.CompositeBase.extend({template:b.templates.visitors_collection,itemView:a.Views.Visitor,itemViewContainer:"#visitors-container",emptyView:a.Views.NoVisitors,className:"visitors-collection",collectionEvents:{sort:"renderCollection"},itemViewOptions:function(b){return{tagName:a.Objects.Models.page.get("visitorTag"),collection:b.get("controls")}},initialize:function(){window.setInterval(c.bind(this.updateTimers,this),2E3);this.on("render",this.updateTimers,
this)},updateTimers:function(){a.Utils.updateTimers(this.$el,".timesince")}})})(Mibew,Handlebars,_);
