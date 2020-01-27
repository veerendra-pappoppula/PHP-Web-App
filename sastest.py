import saspy, pandas as pd, MySQLdb as m

from IPython.display import HTML

sess= saspy.SASsession()

q= sess.submit('''proc sql;

select libname
,memname as dataset_name
,name
from dictionary.columns
where libname in ('WCUDATA'
,'WCUDW'
,'WCUSREP'
,'WCUSLIVE'
)
;

quit;
''')

#print (q['LST'])

df = pd.read_html(q['LST'])[0]


#print(type(df))

#print(len(df))

lista=[]



#print(df[0])
##d=sess.sasdata('dataset', 'wcudata')
##
##d.head()

##
##for i in df.iterrows():
##    print(i)

data = df.loc[:,['Library Name','Member Name','Column Name']].values.tolist()

#print(data)

try:
    conn=m.connect(user='IR', password='IRMIS13',
                                 host='localhost',
                                 database='sas')
except:
    print('MySQL Connection Error')

cur=conn.cursor()

cur.execute('truncate table sas.datasets_columns ;')

query=''' insert into sas.datasets_columns (libname, dataset_name, column_name) values (%s,%s,%s)'''
cur.executemany(query,data)

conn.commit()


    

