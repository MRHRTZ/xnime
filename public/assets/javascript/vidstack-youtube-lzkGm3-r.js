import{c as v,s as $,T as d,p as E,e as g,a as f,i as R,b as B,d as u,f as j}from"./index-DsPXEYOx.js";import{E as V,t as b}from"./vidstack-ENG7LFZW-DeuIgCJj.js";var o=(i=>(i.Play="playVideo",i.Pause="pauseVideo",i.Seek="seekTo",i.Mute="mute",i.Unmute="unMute",i.SetVolume="setVolume",i.SetPlaybackRate="setPlaybackRate",i))(o||{}),c=(i=>(i[i.Unstarted=-1]="Unstarted",i[i.Ended=0]="Ended",i[i.Playing=1]="Playing",i[i.Paused=2]="Paused",i[i.Buffering=3]="Buffering",i[i.Cued=5]="Cued",i))(c||{});const r=class r extends V{constructor(){super(...arguments),this.scope=v(),this.f=$(""),this.g=-1,this.h=-1,this.i=0,this.j=new d(0,0),this.k=null,this.c=null,this.d=null,this.$$PROVIDER_TYPE="YOUTUBE",this.language="en",this.color="red",this.cookies=!1}get a(){return this.b.delegate.a}get currentSrc(){return this.k}get type(){return"video"}get videoId(){return this.f()}preconnect(){const t=[this.m(),"https://www.google.com","https://i.ytimg.com","https://googleads.g.doubleclick.net","https://static.doubleclick.net"];for(const s of t)E(s,"preconnect")}setup(t){this.b=t,super.setup(t),g(this.q.bind(this)),g(this.r.bind(this)),this.a("provider-setup",this)}async play(){const{paused:t}=this.b.$state;if(f(t))return this.c||(this.c=b(()=>{if(this.c=null,t())return"Timed out."}),this.e(o.Play)),this.c.promise}async pause(){const{paused:t}=this.b.$state;if(!f(t))return this.d||(this.d=b(()=>{this.d=null,t()}),this.e(o.Pause)),this.d.promise}setMuted(t){t?this.e(o.Mute):this.e(o.Unmute)}setCurrentTime(t){this.e(o.Seek,t)}setVolume(t){this.e(o.SetVolume,t*100)}setPlaybackRate(t){this.e(o.SetPlaybackRate,t)}async loadSource(t){var e;if(!R(t.src)){this.k=null,this.f.set("");return}const s=(e=t.src.match(r.p))==null?void 0:e[1];this.f.set(s??""),this.k=t}m(){return this.cookies?"https://www.youtube.com":"https://www.youtube-nocookie.com"}q(){this.s();const t=this.f();if(!t){this.t.set("");return}this.t.set(`${this.m()}/embed/${t}`)}r(){const t=this.f(),s=r.l;if(!t)return;if(s.has(t)){const h=s.get(t);this.a("poster-change",h);return}const e=new AbortController;return this.u(t,e),()=>{e.abort()}}async u(t,s){try{const e=["maxresdefault","sddefault","hqdefault"];for(const h of e)for(const n of[!0,!1]){const a=this.v(t,h,n);if((await fetch(a,{mode:"no-cors",signal:s.signal})).status<400){r.l.set(t,a),this.a("poster-change",a);return}}}catch{}this.a("poster-change","")}v(t,s,e){return`https://i.ytimg.com/${e?"vi_webp":"vi"}/${t}/${s}.${e?"webp":"jpg"}`}C(){const{keyDisabled:t}=this.b.$props,{$iosControls:s}=this.b,{controls:e,muted:h,playsinline:n}=this.b.$state,a=e()||s();return{autoplay:0,cc_lang_pref:this.language,cc_load_policy:a?1:void 0,color:this.color,controls:a?1:0,disablekb:!a||t()?1:0,enablejsapi:1,fs:1,hl:this.language,iv_load_policy:a?1:3,mute:h()?1:0,playsinline:n()?1:0}}e(t,s){this.w({event:"command",func:t,args:s?[s]:void 0})}D(){window.setTimeout(()=>this.w({event:"listening"}),100)}x(t){this.b.delegate.E(void 0,t)}y(t){var s;(s=this.d)==null||s.resolve(),this.d=null,this.a("pause",void 0,t)}z(t,s){const{duration:e,currentTime:h}=this.b.$state,n=this.g===c.Ended?e():t,a={currentTime:n,played:this.i>=n?this.j:this.j=new d(0,this.i)};this.a("time-update",a,s),Math.abs(n-h())>1&&this.a("seeking",n,s)}n(t,s,e){const h={buffered:new d(0,t),seekable:s};this.a("progress",h,e);const{seeking:n,currentTime:a}=this.b.$state;n()&&t>a()&&this.o(e)}o(t){const{paused:s,currentTime:e}=this.b.$state;window.clearTimeout(this.h),this.h=window.setTimeout(()=>{this.a("seeked",e(),t),this.h=-1},s()?100:0)}A(t){const{seeking:s}=this.b.$state;s()&&this.o(t),this.a("end",void 0,t)}B(t,s){var a;const{paused:e}=this.b.$state,h=t===c.Playing,n=t===c.Buffering;switch(n&&this.a("waiting",void 0,s),e()&&(n||h)&&((a=this.c)==null||a.resolve(),this.c=null,this.a("play",void 0,s)),t){case c.Cued:this.x(s);break;case c.Playing:this.a("playing",void 0,s);break;case c.Paused:this.y(s);break;case c.Ended:this.A(s);break}this.g=t}F({info:t},s){var a;if(!t)return;const{title:e,duration:h,playbackRate:n}=this.b.$state;if(B(t.videoData)&&t.videoData.title!==e()&&this.a("title-change",t.videoData.title,s),u(t.duration)&&t.duration!==h()){if(u(t.videoLoadedFraction)){const l=((a=t.progressState)==null?void 0:a.loaded)??t.videoLoadedFraction*t.duration,p=new d(0,t.duration);this.n(l,p,s)}this.a("duration-change",t.duration,s)}if(u(t.playbackRate)&&t.playbackRate!==n()&&this.a("rate-change",t.playbackRate,s),t.progressState){const{current:l,seekableStart:p,seekableEnd:k,loaded:w,duration:m}=t.progressState;this.z(l,s),this.n(w,new d(p,k),s),m!==h()&&this.a("duration-change",m,s)}if(u(t.volume)&&j(t.muted)){const l={muted:t.muted,volume:t.volume/100};this.a("volume-change",l,s)}u(t.playerState)&&t.playerState!==this.g&&this.B(t.playerState,s)}s(){this.g=-1,this.h=-1,this.i=0,this.j=new d(0,0),this.c=null,this.d=null}};r.p=/(?:youtu\.be|youtube|youtube\.com|youtube-nocookie\.com)\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=|)((?:\w|-){11})/,r.l=new Map;let y=r;export{y as YouTubeProvider};
