You should put some WAV files here for "randomsound" to function.

The WAV files need to be mono 16bit PCM WAV files with a sampling rate of 8kHz.

Linux users might want to use mpg123 to convert the file:
```sh
mpg123 --rate 8000 --mono -w output.wav input.mp3
```
