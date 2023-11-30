import{c as $,T as l,s as T,p as R,e as P,a as S,i as L,F as x,L as f,l as Q,Q as w}from"./index-DsPXEYOx.js";import{R as q}from"./vidstack-92SHiIen-LZy8uKYB.js";import{E as F,t as G}from"./vidstack-ENG7LFZW-DeuIgCJj.js";var h=(s=>(s.AddEventListener="addEventListener",s.DisableTextTrack="disableTextTrack",s.EnableTextTrack="enableTextTrack",s.ExitFullscreen="exitFullscreen",s.ExitPictureInPicture="exitPictureInPicture",s.GetBuffered="getBuffered",s.GetCuePoints="getCuePoints",s.GetChapters="getChapters",s.GetCurrentTime="getCurrentTime",s.GetDuration="getDuration",s.GetFullscreen="getFullscreen",s.GetPictureInPicture="getPictureInPicture",s.GetPlayed="getPlayed",s.GetQualities="getQualities",s.GetQuality="getQuality",s.GetSeekable="getSeekable",s.GetSeeking="getSeeking",s.GetTextTracks="getTextTracks",s.GetVideoTitle="getVideoTitle",s.HideOverlay="_hideOverlay",s.Pause="pause",s.Play="play",s.RequestFullscreen="requestFullscreen",s.RequestPictureInPicture="requestPictureInPicture",s.SeekTo="seekTo",s.SetMuted="setMuted",s.SetPlaybackRate="setPlaybackRate",s.SetQuality="setQuality",s.SetVolume="setVolume",s.ShowOverlay="_showOverlay",s.Destroy="destroy",s.LoadVideo="loadVideo",s.Unload="unload",s))(h||{});const D=["bufferend","bufferstart","durationchange","ended","enterpictureinpicture","error","fullscreenchange","leavepictureinpicture","loaded","pause","play","playbackratechange","qualitychange","seeked","seeking","timeupdate","volumechange","waiting"];var r=(s=>(s.BufferEnd="bufferend",s.BufferStart="bufferstart",s.CueChange="cuechange",s.DurationChange="durationchange",s.Ended="ended",s.EnterPictureInPicture="enterpictureinpicture",s.Error="error",s.FullscreenChange="fullscreenchange",s.LeavePictureInPicture="leavepictureinpicture",s.Loaded="loaded",s.LoadedData="loadeddata",s.LoadedMetadata="loadedmetadata",s.LoadProgress="loadProgress",s.LoadStart="loadstart",s.Pause="pause",s.Play="play",s.PlaybackRateChange="playbackratechange",s.PlayProgress="playProgress",s.Progress="progress",s.QualityChange="qualitychange",s.Ready="ready",s.Seeked="seek",s.Seeking="seeking",s.TextTrackChange="texttrackchange",s.VolumeChange="volumechange",s.Waiting="waiting",s))(r||{});const d=class d extends F{constructor(){super(...arguments),this.scope=$(),this.i=0,this.j=new l(0,0),this.G=new l(0,0),this.c=null,this.d=null,this.I=null,this.f=T(""),this.H=T(!1),this.J=null,this.k=null,this.N=null,this.K=new q(this.O.bind(this)),this.$$PROVIDER_TYPE="VIMEO",this.cookies=!1,this.title=!0,this.byline=!0,this.portrait=!0,this.color="00ADEF"}get a(){return this.b.delegate.a}get type(){return"video"}get currentSrc(){return this.k}get videoId(){return this.f()}get hash(){return this.J}get isPro(){return this.H()}preconnect(){const e=[this.m(),"https://i.vimeocdn.com","https://f.vimeocdn.com","https://fresnel.vimeocdn.com"];for(const t of e)R(t,"preconnect")}setup(e){this.b=e,super.setup(e),P(this.q.bind(this)),P(this.P.bind(this)),P(this.Q.bind(this)),this.a("provider-setup",this)}destroy(){this.s(),this.e(h.Destroy)}async play(){const{paused:e}=this.b.$state;if(S(e))return this.c||(this.c=G(()=>{if(this.c=null,e())return"Timed out."}),this.e(h.Play)),this.c.promise}async pause(){const{paused:e}=this.b.$state;if(!S(e))return this.d||(this.d=G(()=>{if(this.d=null,!e())return"Timed out."}),this.e(h.Pause)),this.d.promise}setMuted(e){this.e(h.SetMuted,e)}setCurrentTime(e){this.e(h.SeekTo,e)}setVolume(e){this.e(h.SetVolume,e)}setPlaybackRate(e){this.e(h.SetPlaybackRate,e)}async loadSource(e){if(!L(e.src)){this.k=null,this.J=null,this.f.set("");return}const t=e.src.match(d.p),i=t==null?void 0:t[1],a=t==null?void 0:t[2];this.f.set(i??""),this.J=a??null,this.k=e}q(){this.s();const e=this.f();if(!e){this.t.set("");return}this.t.set(`${this.m()}/video/${e}`)}P(){const e=this.t(),t=this.f(),i=d.M,a=i.get(t);if(!t)return;const n=x();if(this.I=n,a){n.resolve(a);return}const u=`https://vimeo.com/api/oembed.json?url=${e}`,o=new AbortController;return window.fetch(u,{mode:"cors",signal:o.signal}).then(c=>c.json()).then(c=>{var g,v;const p=/vimeocdn.com\/video\/(.*)?_/,b=(v=(g=c==null?void 0:c.thumbnail_url)==null?void 0:g.match(p))==null?void 0:v[1],k=b?`https://i.vimeocdn.com/video/${b}_1920x1080.webp`:"",y={title:(c==null?void 0:c.title)??"",duration:(c==null?void 0:c.duration)??0,poster:k,pro:c.account_type!=="basic"};i.set(t,y),n.resolve(y)}).catch(c=>{n.reject(),this.a("error",{message:`Failed to fetch vimeo video info from \`${u}\`.`,code:1})}),()=>{n.reject(),o.abort()}}Q(){const e=this.H(),{$state:t,qualities:i}=this.b;if(t.canSetPlaybackRate.set(e),i[f.ca](!e),e)return Q(i,"change",()=>{var n;if(i.auto)return;const a=(n=i.selected)==null?void 0:n.id;a&&this.e(h.SetQuality,a)})}m(){return"https://player.vimeo.com"}C(){const{$iosControls:e}=this.b,{keyDisabled:t}=this.b.$props,{controls:i,muted:a,playsinline:n}=this.b.$state,u=i()||e();return{title:this.title,byline:this.byline,color:this.color,portrait:this.portrait,controls:u,h:this.hash,keyboard:u&&!t(),transparent:!0,muted:a(),playsinline:n(),dnt:!this.cookies}}O(){this.e(h.GetCurrentTime)}z(e,t){const{currentTime:i,paused:a,bufferedEnd:n}=this.b.$state;if(i()===e)return;const u=i(),o={currentTime:e,played:this.i>=e?this.j:this.j=new l(0,this.i)};this.a("time-update",o,t),Math.abs(u-e)>1.5&&(this.a("seeking",e,t),!a()&&n()<e&&this.a("waiting",void 0,t))}o(e,t){this.a("seeked",e,t)}x(e){var i;const t=this.f();(i=this.I)==null||i.promise.then(a=>{if(!a)return;const{title:n,poster:u,duration:o,pro:c}=a;this.K.da(),this.H.set(c),this.G=new l(0,o),this.a("poster-change",u,e),this.a("title-change",n,e),this.a("duration-change",o,e);const p={buffered:new l(0,0),seekable:this.G,duration:o};this.b.delegate.E(p,e);const{$iosControls:b}=this.b,{controls:k}=this.b.$state;k()||b()||this.e(h.HideOverlay),this.e(h.GetQualities)}).catch(a=>{t===this.f()&&this.a("error",{message:`Failed to fetch oembed data: ${a}`,code:2})})}R(e,t,i){switch(e){case h.GetCurrentTime:this.z(t,i);break;case h.GetChapters:break;case h.GetQualities:this.S(t,i);break}}T(){for(const e of D)this.e(h.AddEventListener,e)}y(e){var t;this.a("pause",void 0,e),(t=this.d)==null||t.resolve(),this.d=null}U(e){var t;this.a("play",void 0,e),(t=this.c)==null||t.resolve(),this.c=null}V(e){const{paused:t}=this.b.$state;t()||this.a("playing",void 0,e)}W(e,t){const i={buffered:new l(0,e),seekable:this.G};this.a("progress",i,t)}X(e){this.a("waiting",void 0,e)}Y(e){const{paused:t}=this.b.$state;t()||this.a("playing",void 0,e)}Z(e){const{paused:t}=this.b.$state;t()&&this.a("play",void 0,e),this.a("waiting",void 0,e)}_(e,t){const i={volume:e,muted:e===0};this.a("volume-change",i,t)}S(e,t){this.b.qualities[w.ea]=e.some(i=>i.id==="auto")?()=>{this.e(h.SetQuality,"auto")}:void 0;for(const i of e){if(i.id==="auto")continue;const a=+i.id.slice(0,-1);isNaN(a)||this.b.qualities[f.fa]({id:i.id,width:a*(16/9),height:a,codec:"avc1,h.264",bitrate:-1},t)}this.L(e.find(i=>i.active),t)}L({id:e}={},t){if(!e)return;const i=e==="auto",a=this.b.qualities.toArray().find(n=>n.id===e);i?(this.b.qualities[w.ga](i,t),this.b.qualities[f.$](void 0,!0,t)):this.b.qualities[f.$](a,!0,t)}aa(e,t,i){switch(e){case r.Ready:this.T();break;case r.Loaded:this.x(i);break;case r.Play:this.U(i);break;case r.PlayProgress:this.V(i);break;case r.Pause:this.y(i);break;case r.LoadProgress:this.W(t.seconds,i);break;case r.Waiting:this.Z(i);break;case r.BufferStart:this.X(i);break;case r.BufferEnd:this.Y(i);break;case r.VolumeChange:this._(t.volume,i);break;case r.DurationChange:this.G=new l(0,t.duration),this.a("duration-change",t.duration,i);break;case r.PlaybackRateChange:this.a("rate-change",t.playbackRate,i);break;case r.QualityChange:this.L(t,i);break;case r.FullscreenChange:this.a("fullscreen-change",t.fullscreen,i);break;case r.EnterPictureInPicture:this.a("picture-in-picture-change",!0,i);break;case r.LeavePictureInPicture:this.a("picture-in-picture-change",!1,i);break;case r.Ended:this.a("end",void 0,i);break;case r.Error:this.ba(t,i);break;case r.Seeked:this.o(t.seconds,i);break}}ba(e,t){var i;if(e.method==="play"){(i=this.c)==null||i.reject(e.message);return}}F(e,t){e.event?this.aa(e.event,e.data,t):e.method&&this.R(e.method,e.value,t)}D(){}e(e,t){return this.w({method:e,value:t})}s(){this.K.ha(),this.i=0,this.j=new l(0,0),this.G=new l(0,0),this.c=null,this.d=null,this.I=null,this.N=null,this.H.set(!1)}};d.p=/(?:https:\/\/)?(?:player\.)?vimeo(?:\.com)?\/(?:video\/)?(\d+)(?:\?hash=(.*))?/,d.M=new Map;let I=d;export{I as VimeoProvider};