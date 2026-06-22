  library(readxl)
  HEALTHCARE_1 <- read_excel("C:/Users/ASUS TUF GAMING/Downloads/HEALTHCARE 1.xlsx")
  
  #view a few row of data
  head(HEALTHCARE_1)
  
  #perform regression
  model <- lm(HEALTHCARE_1$BMI ~ HEALTHCARE_1$WeightInKilograms, HEALTHCARE_1=HEALTHCARE_1)
  model
  summary(model)
  
  #plot the graph
  plot(HEALTHCARE_1$WeightInKilograms, HEALTHCARE_1$BMI)
  abline(model)