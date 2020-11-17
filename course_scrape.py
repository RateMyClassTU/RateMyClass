import re
from bs4 import BeautifulSoup as bs
import requests
import json

data = {}
r = requests.get("https://bulletin.temple.edu/undergraduate/schools-colleges/")
soup = bs(r.content, features="lxml")


contents = soup.select("div#textcontainer a[href]")
count = 0

#Departments
for i in contents:
    c_link = "https://bulletin.temple.edu"+i["href"]
    A_str = contents[count].string
    #A_href = "https://bulletin.temple.edu"+i["href"]
    data[A_str]=[]

    r = requests.get(c_link)
    soup = bs(r.content, features="lxml")
    links = soup.select("div#cl-menu li.active li.active li.active.self ul li a[href]")
    count2 =0
    
    #Subjects
    for j in links:
        temp = links[count2].string
        # print("\t"+temp+" -> "+"https://bulletin.temple.edu"+j["href"]+"\n")
        F = {temp:[]}
        

        #GET COURSES
        r = requests.get("https://bulletin.temple.edu"+j["href"])
        soup = bs(r.content, features="lxml")

        #course_list = []

        course_blocks = soup.select("div.courseblock")

        count3 = 0
        for x in course_blocks:
            k = soup.select("div.courseblock p.courseblocktitle") #name
            l = soup.select("div.courseblock div.courseblockheaddiv") #desc
            name = k[count3].string
            name = name.replace(u'\xa0', u' ')
            temp2 = {name:l[count3].string}
            F[temp].append(temp2.copy())
            count3 = count3+1
        
        # print("\t\t\t\t\t\t__________________COURSES_________________ ["+temp+"]\n\n")
        # print('\n\n'.join(map(str, course_list))) 
        # print("\n\n")
        
        count2 = count2+1
        data[A_str].append(F)

    #print("\n\n")
    count = count+1

#print("\n\n")

with open('courses.json', 'w') as outfile:
    json.dump(data, outfile, indent=4,sort_keys=True)

#JSON FILE FORMAT
# {
#     "college1":[  
#         {"major1":[
#             {"course1name":"course1desc"},
#             {"course2name":"course2desc"}
#         ]},
#         {"major2":[
#             {"course1name":"course1desc"},
#             {"course2name":"course2desc"}
#         ]}
#     ],
#     "college2":[
#         {"major1":[
#             {"course1name":"course1desc"},
#             {"course2name":"course2desc"}
#         ]},
#         {"major2":[
#             {"course1name":"course1desc"},
#             {"course2name":"course2desc"}
#         ]}
#     ]

# }

#ALTERNATIVE TO CLEANING HTMLL IMPORTED STRING OF WIERD CHARACTERS
# import lxml.html
# import lxml.html.clean
# html = "ARTE\xa03202"
# doc = lxml.html.fromstring(html)
# cleaner = lxml.html.clean.Cleaner(style=True)
# doc = cleaner.clean_html(doc)
# text = doc.text_content()
# print(text)