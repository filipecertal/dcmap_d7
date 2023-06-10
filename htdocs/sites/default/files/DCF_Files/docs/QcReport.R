library(RODBC)
library(mapplots)
library(tools)
library(xtable)
library(lattice)

setwd("//galwayfs03/FishData/DISCARDS/QcReports/Code")

source("QcReportFunctions.R")

# update haul and raising factors data of all trips (for figure 1)
# this doesn not have to be done every time (once in a while is fine)
channel <- odbcDriverConnect("Driver=SQL Server; Server=myServer; Database=myDatabase")
  sqlQuery(channel,readChar("SampleRF_all.sql",10^6))
  SRF0 <- sqlQuery(channel,"select * from #srf")
  sqlQuery(channel,readChar("Haul_all.sql",10^6))
  HAUL0 <- sqlQuery(channel,"select * from #haul")
close(channel)
save('SRF0','HAUL0',file='AllTrips.Rdata')


# generate a report for a single trip
trip <- "FAT/CTB/17/4"
QcReport(trip)


channel <- odbcDriverConnect("Driver=SQL Server; Server=myServer; Database=myDatabase")
trips <- sqlQuery(channel,"select distinct [Cruise code] as Cruise from CRUISe")
close(channel)

for(trip in trips$Cruise){
  cat(trip,match(trip,trips$Cruise),'of',nrow(trips),'\n') 
  QcReport(trip)
}

# save a csv and png file in the report directory with the outliers of all trips
QcSummary()
