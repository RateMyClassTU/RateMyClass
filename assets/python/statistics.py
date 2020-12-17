#!/home/TU/shi/anaconda3/bin/python
import pymysql
import csv
import matplotlib.pyplot as plt
from datetime import datetime
import os
import numpy as np

import sys
pName=sys.argv[1]
# cName=sys.argv[1]
#pName = "prof1";
#cName = "cis1001"; logically complicated

#make dir
path = "../img/plots/"+pName+"/"
if(not os.path.isdir(path)):
    os.mkdir(path,0o755)

conn = pymysql.connect(host="cis-linux2.temple.edu", user="tuh04803", password="eebiungo", db="FA20_3296_tuh04803") 
cur = conn.cursor()
cur.execute("select * from ProfessorReviews where Professor=%s;",(pName))
conn.commit()
with open("../csv/pReviews.csv", "w", newline='') as csv_file:  # Python 3 version    
    csv_writer = csv.writer(csv_file)
    csv_writer.writerow([i[0] for i in cur.description]) # write headers
    csv_writer.writerows(cur)

conn.close
cur.close

#here are the lists we need
#x axis
timeline = []
teach = []
grade =[]
study = []
rushc = []

#now use csv file to generate and save graphs
with open('../csv/pReviews.csv',"r", newline='') as csvfile:
    reader = csv.reader(csvfile, delimiter=',', quotechar='|')
    count = 0
    for row in reader:
        if(count>0):

            #get column values
            #parslist=str(row[11]).split(",",1)
            t= str(row[11])
            year = int(t[:4])
            timeline.append(year)
            teach.append(row[7])
            grade.append(row[8])
            study.append(row[10])
            rushc.append(row[9])
        count = count+1;



today = datetime.today()
curr_year = today.year

#teaching rating
plt.plot(timeline, teach,'-o')
plt.ylabel("Teaching Rating (1-5)")
plt.xlabel("Timeline in Years")
s = "Teaching Rating for "+pName
plt.title(s)
s= path+"/"+pName+"TeachingRating.png"
plt.savefig(s)
plt.close()

#grading difficulty
plt.plot(timeline, grade,'-o')
plt.ylabel("Grading Difficulty (1-5)")
plt.xlabel("Timeline in Years")
s = "Grading Difficulty for "+pName
plt.title(s)
s= path+"/"+pName+"GradingDifficulty.png"
plt.savefig(s)
plt.close()

#study technique
plt.plot(timeline, study,'g^')
plt.ylabel("Study Technique [self(0),lec(1),both(2)]")
plt.xlabel("Timeline in Years")
s = "Class Study Technique for "+pName
#plt.yticks(np.arange(0,2,1))
plt.title(s)
s= path+"/"+pName+"StudyTechnique.png"
plt.savefig(s)
plt.close()

#rushed curriculum
plt.plot(timeline, rushc,'g^')
plt.ylabel("Curriculum Rushed? [No(0), Yes(1)]")
plt.xlabel("Timeline in Years")
s = "Whether "+pName+" Rushes Class Curriculums?"
plt.title(s)
s= path+"/"+pName+"RushedCurriculum.png"
plt.savefig(s)
plt.close()