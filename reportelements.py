#!/usr/bin/python
# -*- coding: utf-8 -*-

import os, pandas as pd, json
from pandas.io.json import json_normalize 

df= pd.read_csv('/mnt/sasfolder/PRD/DATA/report_members.txt',names=['folder','id','name','type','description','uri'], delimiter=',')

reports= df.loc[:,['name','uri']].values

#print reports
filepath='/mnt/sasfolder/PRD/DATA/report_elements/'
data = []


#for f in reports:
	#print f[0]
	#filename= filepath+"'"+f[0]+"'"+'.json'
	#print filename
	#os.system("./callrestapi.py -m get -e {}/content/elements > {}".format(f[1], filename))

for file in os.listdir(filepath):
	#print file
	df2= json.load((open(os.path.join(filepath,file))))
	#df2= pd.read_json(os.path.join(filepath,file))
	#df2=pd.DataFrame.from_dict(os.path.join(filepath,file), orient='index')
	break

#print df2

for i in df2:
	#print(i)
	if i=='items':
    		for j in i:
			if j=='Type':
				print j

#df3=dict(df2.items('type'))

#print df3


#df3=dict((k, df2[k]) for k in ('items'))

#if df2['items']['type']=='DataSource':
#	print df2['items']['label']

#print type(df3)

#print df['type'=='DataSource']

#print f
#elevations = elements_json.read()
#data = json.loads(elevations)
#json_normalize(data['type'])