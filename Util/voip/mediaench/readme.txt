These is an optional module. These files are needed if you wish to enable one of the following parameters: aec (echo cancellation), agc (automatic gain control), denoise, silencesupress.
These files should be stored near the webphone.jar file on your server and you might have to enable the dll and dylib mime type on your web server (or set the “mediaenchext” applet parameter to “jar” and rename dll with jar in file name extensions). If the files cannot be found or loaded than the webphone will just not use these features but will remain fully functional. You should test the dll and dylib availability by directly accessing from the browser with the exact url (For example: www.mydomain.com/webphone/mediaench.dll). The browser should be able to download the dll or the jar. 
The webphone will download one of these libraries only at the first usage and subsequent usage will be served from the local cache.


Applet parameters:

aec
(int)
Enable/disable acoustic echo cancellation
0=no,1=yes except if headset is guessed,2=yes always
Default is 1

agc
(int)
Automatic gain control. 
0=Disabled
1=For recording only
2=Both for playback and recording
Default value is 2


denoise
(int)
Noise suppression.
0=Disabled
1=For recording only
2=Both for playback and recording
Default value is 2


silencesupress
(int)
Enable/disable silence suppression
Usually not recommended unless your bandwidth is really bad and expensive.
0=no,1=yes
Default is 0  (disabled)
