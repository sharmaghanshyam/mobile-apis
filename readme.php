Here You will get all the api calls and their detailed description. All calls are provided here. These apis returns in json format which is much faster then XML format. All the code has been already written in the files you just need to call these url with the particular methods and decode the result in iphone or android appa you can also use these services for website for that you need to use CURL in you application to get the results. 
To use these api's need to upload api folder on you root folder on your server. so the url will be - http://www.example.com/api 

1. Get country list from database.
2. Get state list according to particular country from database.
3. Get city list accordig to state from database.
4. Get currency converter value.
5. Get latitude, longitude, currency symbol etc for particular IP Adress.
6. Get stock market report for particular ticker code(AAPL, GOOG etc). 
7. Get Weather result for particular city(cityname or zipcode). 
8. Login api to login in any application using database. 
9. Check email address exist in database or not.
10. Count you current age.
11. Create new account for any application using database
1. Get country list from database

URL - http://www.example.com/api/commonapi.php?Code=country 
METHOD -GET
PARAMETER - Code 
Response - {	"Status":"Success", "Message":"Data retreived succesfully!", "Result": { "countryList": [ { "id":"42", "name":"Canada" }, { "id":"109", "name":"India" }, { "id":"152", "name":"Mexico" }, { "id":"253", "name":"United States" } ] } }

2. Get state list according to particular country from database

URL - http://www.example.com/api/commonapi.php?Code=state&countryid=253
METHOD -GET
PARAMETER - 1. Code 2. countryid 
Response - { "Status":"Success", "Message":"Data retreived succesfully!", "Result": {	"stateList": [ { "id":"1", "name":"Alabama" }, { "id":"2", "name":"Alaska" }, { "id":"3", "name":"Arizona" } ] } }

3. Get city list accordig to state from database

URL - http://www.example.com/api/commonapi.php?Code=city&stateid=1
METHOD -GET
PARAMETER - 1. Code 2. stateid 
Response - { "Status":"Success", "Message":"Data retreived succesfully!", "Result": { "cityList": [ { "id":"1", "name":"Huntsville" }, { "id":"2", "name":"Mobile" }, { "id":"3", "name":"Montgomery" }, { "id":"4", "name":"Little Rock" } ] } }

4. Get currency converter value

URL - http://www.example.com/api/currencyConverterapi.php
METHOD -POST
PARAMETER - 1. fromCurrency 2. toCurrency 3. amount 
Response - { "Status":"Success", "Message":"Data retreived succesfully!", "Result":743.23 }

5. Get latitude, longitude, currency symbol etc for particular IP Adress

URL - http://www.example.com/api/ipAddressapi.php
METHOD -POST
PARAMETER - 1. ipAddress 
Response - {	"Status":"Success", "Message":"Data retreived succesfully!", "Result":{ "geoplugin_request":"122.175.169.129", "geoplugin_status":200, "geoplugin_city":"Kaul", "geoplugin_region":"Hary \u0101na", "geoplugin_countryCode":"IN", "geoplugin_countryName":"India", "geoplugin_continentCode":"AS", "geoplugin_latitude":"29.85", "geoplugin_longitude":"76.666702", "geoplugin_regionCode":"10", "geoplugin_regionName":"Hary\u0101na", "geoplugin_currencyCode":"INR", "geoplugin_currencySymbol":"?", "geoplugin_currencySymbol_UTF8":"\u20a8", "geoplugin_currencyConverter":"61.9375" } }

6. Get stock market report for particular ticker code(AAPL, GOOG etc)

URL - http://www.example.com/api/commonapi.php?Code=stock&tickerCode=AAPL
METHOD - GET
PARAMETER - 1. Code 2. tickerCode 
Response - { "Status":"Success", "Message":"Data retreived succesfully!", "Result":{ "imageticker":"http://ichart.finance.yahoo.com/b?s=AAPL", "gettradeval":	{ "Ask":"553.20", "Average Daily Volume":"11248700", "Ask Size":"600", "Bid":"553.12", "Ask (Real-time)":"553.20", "Bid (Real-time)":"553.12", "Book Value":"137.397", "Bid Size":"100", "Change & Percent Change":"-5.57 - -0.99%", "Change":"-5.57", "Commission":"-", "Change (Real-time)":"-5.57", "After Hours Change (Real-time)":"N\/A - N\/A", "Dividend\/Share":"11.80", "Last Trade Date":"12\/30\/2013", "Trade Date":"-", "Earnings\/Share":"39.75", "Error Indication (returned for symbol changed \/invalid)":"N\/A", "EPS Estimate Current Year":"43.71", "EPS Estimate Next Year":"47.89", "EPS Estimate Next Quarter":"10.88", "Float Shares":" 898523000", "Days Low":"552.321", "Days High":"560.09", "52-week Low":"385.10", "52-week High":"575.14", "Holdings Gain Percent":"- - -", "Annualized Gain":"-", "Holdings Gain":"-", "Holdings Gain Percent (Real-time)":"N\/A - N\/A", "Holdings Gain (Real-time)":"N\/A", "More Info":"cnsprmiIed", "Order Book (Real-time)":"N\/A", "Market Capitalization":"498.9B", "Market Cap (Real-time)":"N\/A", "EBITDA":"55.756B", "Change From 52-week Low":"+169.42", "Percent Change From 52-week Low":"+43.99%", "Last Trade (Real-time) With Time":"N\/A - 554.52<\/b>", "Change Percent (Real-time)":"208261", "Last Trade Size":"N\/A - -0.99%", "Change From 52-week High":"-20.62", "Percebt Change From 52-week High":"-3.59%", "Last Trade (With Time)":"Dec 30 - 554.52<\/b>", "Last Trade (Price Only)":"554.52", "High Limit":"-", "Low Limit":"-", "Days Range":"552.321 - 560.09", "Days Range (Real-time)":"N\/A - N\/A", "50-day Moving Average":"545.821", "200-day Moving Average":"489.461", "Change From 200-day Moving Average":"+65.059", "Percent Change From 200-day Moving Average":"+13.29%", "Change From 50-day Moving Average":"+8.699", "Percent Change From 50-day Moving Average":"+1.59%", "Notes":"-", "Open":"557.46", "Previous Close":"560.09", "Price Paid":"-", "Change in Percent":"-0.99%", "Price\/Sales":"2.95", "Price\/Book":"4.08", "Ex-Dividend Date":"Nov 6", "P\/E Ratio":"14.09", "Dividend Pay Date":"Nov 14", "P\/E Ratio (Real-time)":"N\/A", "PEG Ratio":"0.91", "Price\/EPS Estimate Current Year":"12.81", "Price\/EPS Estimate Next Year":"11.70", "Symbol":"AAPL", "Shares Owned":"-", "Short Ratio":"1.70", "Last Trade Time":"4:00pm", "1 yr Target Price":"595.73", "Volume":"9058246", "Holdings Value":"-", "Holdings Value (Real-time)":"N\/A", "52-week Range":"385.10 - 575.14", "Days ValuecChange":"- - -0.99%", "Days Value Change (Real-time)":"N\/A - N\/A", "Stock Exchange":"NasdaqNM", "Dividend Yield":"2.11", "Name":" Apple Inc. \r\n" }, "getnews":	[ { "title":"[$$] Apple Feud Deepens With Court-Appointed Monitor", "link":"http:\/\/us.rd.yahoo.com\/finance\/external\/wsj\/rss\/SIG=12gi51o7h\/*http:\/\/online.wsj.com\/article\/SB10001424052702304361604579291042388608328.html?ru=yahoo?mod=yahoo_itp", "description":"[at The Wall Street Journal] - A feud between Apple and a lawyer appointed by a federal court judge to monitor the company's e-book pricing reform is getting more acrimonious.", "pubDate":"Tue, 31 Dec 2013 02:15:32 GMT" }, { "title":"Apple\u2019s CEO Sees \u201cBig Plans\u201d Ahead in 2014", "link":"http:\/\/us.rd.yahoo.com\/finance\/external\/mfool\/rss\/SIG=12v2tknfg\/*http:\/\/www.fool.com\/investing\/general\/2013\/12\/30\/apples-ceo-sees-big-plans-ahead-in-2014.aspx?source=eogyholnk0000001", "description":"[at Motley Fool] - CEO reiterates that Apple has another big year for it ahead.", "pubDate":"Tue, 31 Dec 2013 01:20:09 GMT" } ], "summary":"d market mobile communication and media devices, personal computers, and portable digital music players worldwide. It also sells software, services, peripherals, networking solutions, and third-party digital content and applications related to its products. The company offers iPhone, a line of smartphones that comprise a phone, music player, and Internet device; iPad, a line of multi-purpose tablets based on Apple\u0092s iOS Multi-Touch operating system; Mac, a line of desktop and portable personal computers; and iPod, a line of portable digital music and media players, such as iPod touch, iPod nano, iPod shuffle, and iPod classic. It also provides Apple TV, a portfolio of consumer and professional software applications, the iOS and OS X operating systems, iCloud, and various accessories, service and support offerings; and manufactures the Apple LED Cinema Display and Thunderbolt Display. In addition, the company sells various other application software comprising Final Cut Pro, Logic Pro X, and its FileMaker Pro database software, as well as a range of Apple-branded and third-party Mac-compatible, and iOS-compatible peripheral products, including printers, storage devices, computer memory, digital video and still cameras, pointing devices, and various other computing products and supplies. Apple Inc. sells digital content and applications through the iTunes Store, App Store, iBooks Store, and Mac App Store; and its products through its retail stores, online stores, and direct sales force, as well as through third-party cellular network carriers, wholesalers, retailers, and value-added resellers. The company also sells a range of third-party products through its online and retail stores. It serves various consumers, small and mid-sized businesses, as well as education, enterprise, and government customers. Apple Inc. w" } }

7.Get Weather result for particular city(cityname or zipcode)

URL - http://www.example.com/api/commonapi.php?Code=weather&query=10001
METHOD -GET
PARAMETER - 1. Code 2. query 
Response - { "search_api": { "result": [ {	"areaName": [ {	"value": "Greenwich Village" } ], "country": [ { "value": "United States Of America" } ], "latitude": "40.728", "longitude": "-74.003", "population": "0", "region": [ {"value": "New York" } ], "weatherUrl": [ {"value": "http:\/\/www.worldweatheronline.com\/Greenwich-Village-weather\/New-York\/US.aspx" } ] }, { "areaName": [ {"value": "Weehawken" } ], "country": [ {"value": "United States Of America" } ], "latitude": "40.769", "longitude": "-74.021", "population": "14104", "region": [ {"value": "New Jersey" } ], "weatherUrl": [ {"value": "http:\/\/www.worldweatheronline.com\/Weehawken-weather\/New-Jersey\/US.aspx" } ] }, { "areaName": [ {"value": "Hoboken" } ], "country": [ {"value": "United States Of America" } ], "latitude": "40.744", "longitude": "-74.033", "population": "39738", "region": [ {"value": "New Jersey" } ], "weatherUrl": [ {"value": "http:\/\/www.worldweatheronline.com\/Hoboken-weather\/New-Jersey\/US.aspx" } ] }, { "areaName": [ {"value": "Long Island City" } ], "country": [ {"value": "United States Of America" } ], "latitude": "40.745", "longitude": "-73.949", "population": "0", "region": [ {"value": "New York" } ], "weatherUrl": [ {"value": "http:\/\/www.worldweatheronline.com\/Long-Island-City-weather\/New-York\/US.aspx" } ] } ] } }

8. Login api to login in any application using database

URL - http://www.example.com/api/loginapi.php
METHOD -POST
PARAMETER - 1. email 2. password 
Response - {	"Status":"Success", "Message":"Data retreived succesfully!", "Result":{ "userDetails": {	"id":"1", "UserName":"gimmy", "Email":"gimmy@gimmy.com" }, "token":"m2wEKNEjmSfUxDoE8mBQA4tn4Ty3uVCD" } }

9. Check email address exist in database or not

URL - http://www.example.com/api/commonapi.php?Code=email&emailid=gimmy@gimmy.com
METHOD -GET
PARAMETER - 1. Code 2. emailid 
Response - {"Status":"Fail","Message":"Email already exist","Result":[[]]}

10. Count your current age

URL - http://www.example.com/api/ageapi.php?dob=26/04/1985
METHOD -GET
PARAMETER - 1. dob 
Response - { "Status":"Success", "Message":"Data retreived succesfully!", "Result":{ "years":28, "months":8, "days":23, "dob":"28 years,8 month,23 days" } }

11. Create new account for any application using database

URL - http://www.example.com/api/signupapi.php
METHOD -POST
PARAMETER - 1. username 2. email 3. password 
Response - {	"Status":"Success", "Message":"Registered succesfully!" }

Contact me

Important Note - Change database details in file DatabaseConnection.php
File path - api/classes/DatabaseConnection.php

Also change weather api key and other messages

Credits - http://www.geoplugin.net 
http:// www.worldweatheronline.com
