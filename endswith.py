import os

fpath='\\\\sasdatap01\\sasdata\\DEV\\DATA'

for f in os.listdir(fpath):
    if f.endswith('.xlsx'):
                      print(f)
