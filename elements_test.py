import os, pandas as pd, json
from pandas.io.json import json_normalize 

#df= pd.read_csv('/mnt/sasfolder/PRD/DATA/report_members.txt',names=['folder','id','name','type','description','uri'], delimiter=',')

#reports= df.loc[:,['name','uri']].values

#print reports
filepath='\\\\sasdatap01\\sasdata\\PRD\\DATA\\report_elements\\'
data = []


#for f in reports:
	#print f[0]
	#filename= filepath+"'"+f[0]+"'"+'.json'
	#print filename
	#os.system("./callrestapi.py -m get -e {}/content/elements > {}".format(f[1], filename))

for file in os.listdir(filepath):
	#print file
	df2= json.load((open(os.path.join(filepath,file))))

#print(type(df2))

#print(type(df2['items']))

#print(type(df2['items'][2]))

#print(df2['items'][i]['type'] for i in range(0, len(df2['items'])))

#print (len(df2['items']))

for i in range(0, len(df2['items'])):
    if df2['items'][i]['type']=='DataSource':
        print(df2['items'][i]['label'])
