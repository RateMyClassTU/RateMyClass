import re
from bs4 import BeautifulSoup as bs
import requests
import json

#data = {}
r = requests.get("https://bulletin.temple.edu/undergraduate/schools-colleges/")
soup = bs(r.content, features="lxml")


contents = soup.select("div#textcontainer a[href]")
count = 0

#Departments
for i in contents:
    c_link = "https://bulletin.temple.edu"+i["href"]
    print(contents[count].string+" -> "+"https://bulletin.temple.edu"+i["href"])
    print("\n")

    r = requests.get(c_link)
    soup = bs(r.content, features="lxml")
    links = soup.select("div#cl-menu li.active li.active li.active.self ul li a[href]")
    count2 =0
    
    #Subjects
    for j in links:
        temp = links[count2].string
        print("\t"+temp+" -> "+"https://bulletin.temple.edu"+j["href"]+"\n")
        
        #GET COURSES
        r = requests.get("https://bulletin.temple.edu"+j["href"])
        soup = bs(r.content, features="lxml")

        course_list = []

        course_blocks = soup.select("div.courseblock")

        count3 = 0
        for i in course_blocks:
            k = soup.select("div.courseblock p.courseblocktitle")
            l = soup.select("div.courseblock div.courseblockheaddiv")
            name = k[count3].string
            name = name.replace(u'\xa0', u' ')
            temp2 = {name:l[count3].string}
            course_list.append(temp2.copy())
            count3 = count3+1
        
        print("\t\t\t\t\t\t__________________COURSES_________________ ["+temp+"]\n\n")
        print('\n\n'.join(map(str, course_list))) 
        print("\n\n")
        
        count2 = count2+1

    print("\n\n")
    count = count+1

print("\n\n")




#ALTERNATIVE TO CLEANING HTMLL IMPORTED STRING OF WIERD CHARACTERS
# import lxml.html
# import lxml.html.clean
# html = "ARTE\xa03202"
# doc = lxml.html.fromstring(html)
# cleaner = lxml.html.clean.Cleaner(style=True)
# doc = cleaner.clean_html(doc)
# text = doc.text_content()
# print(text)