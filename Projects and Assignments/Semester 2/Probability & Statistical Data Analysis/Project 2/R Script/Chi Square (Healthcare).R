library(readxl)
HEALTHCARE_1 <- read_excel("C:/Users/User/Downloads/HEALTHCARE 1.xlsx", 
                           sheet = "chi square")

library(MASS)
# get the contingency table
tbl= table(HEALTHCARE_1$Sex,HEALTHCARE_1$HIVTesting)
tbl

# perform chi-square test on the data table
chisq.test(tbl,correct=FALSE)

#critical value
alpha <-0.05
x2.alpha <-qchisq(alpha, df=1,lower.tail=FALSE)
x2.alpha
output <- chisq.test(tbl,correct = FALSE)
print(x2.alpha)
output$statistic
output$parameter


print("Observed frequency")
output$observed


print("Expected frequency")
output$expected