library(readxl)
library(plotrix)

# Read data from Excel file
responses <- read_excel("C:/Users/Owner/Desktop/PSDA PROJECTO/Responses.xlsx")
View(responses)

# Create frequency tables
genderFreq <- table(responses[,2])

age.matrix <- as.matrix(responses[,3])
age.matrix <- age.matrix[,]

ethnicFreq <- table(responses[,4])
ethnicFreq = ethnicFreq[c(2,4,3,1,5)]

yearFreq <- table(responses[,5])

facultyFreq <- table(responses[,6])

cgpa <- as.matrix(responses[,7])
breaks <- seq(1.8, 4.2, 0.2)
cgpaCut <- cut(cgpa, breaks)
cgpaFreq <- table(cgpaCut)
cgpa.cs <- c(0, cumsum(cgpaFreq))

playGameFreq <- table(responses[,8])

hour <- responses[,9]

agreeEffectFreq <- table(responses[,10])
agreeEffectFreq <- agreeEffectFreq[c(4,2,1,3)]

agreeHabitFreq <- table(responses[,11])
agreeHabitFreq <- agreeHabitFreq[c(4,2,1,3)]

habit <- as.matrix(responses[,12])
habit <- unlist(strsplit(habit, ", "))
habitFreq <- table(habit)
habitFreq <- habitFreq[c(2,4,3,6,5,1)]

agreeBenefitFreq <- table(responses[,13])
agreeBenefitFreq <- agreeBenefitFreq[c(4,2,1,3)]

benefit <- as.matrix(responses[,14])
benefit <- unlist(strsplit(benefit, ", "))
benefitFreq <- table(benefit)
benefitFreq <- benefitFreq[c(5,2,3,4,1,6)]

yesNoFreq <- table(responses[,15])

# Plotting
pie3D(genderFreq,
      labels = names(genderFreq),
      col = rainbow(length(genderFreq)),
      main = "Genders of Respondents",
      explode = 0.025
)

barplot(ethnicFreq,
        col = rainbow(length(ethnicFreq)),
        ylab = "Frequency",
        xlab = "Ethnic",
        main = "Ethnics of Respondents"
)

pie(facultyFreq,
    labels = names(facultyFreq),
    main = "Faculties of Respondents",
    col = rainbow(length(facultyFreq))
)

stripchart(age.matrix,
         method = "stack",
         offset = 0.25,
         at = 0,
         pch = 19,
         col = "steelblue",
         main = "Age of each respondent",
         xlab = "Age",
         cex = 1.2
)

barplot(yearFreq,
        col = rainbow(length(yearFreq)),
        xlab = "Frequency",
        ylab = "Year",
        main = "Academic Year of Respondents",
        horiz = TRUE
)

barplot(habitFreq,
        col = rainbow(length(habitFreq)),
        ylab = "Frequency",
        ylim = c(0,50),
        xlab = "Bad Habits",
        main = "Bad Habits of Playing Games among Respondents"
)

barplot(benefitFreq,
        col = rainbow(length(benefitFreq)),
        ylab = "Frequency",
        ylim = c(0,50),
        xlab = "Benefits",
        main = "Benefits of Playing Games among Respondentss"
)

pie(playGameFreq,
    labels = names(playGameFreq),
    main = "How Often the Respondants Play Games",
    col = rainbow(length(playGameFreq)),
)

plot(breaks, cgpa.cs,
     ylab = "Frequency",
     xlab = "CGPA Interval",
     main = "Ogive for CGPA Among the Respondents"
)
lines(breaks, cgpa.cs)

boxplot(hour,
        main = "Frequency of Video Games Time",
        ylab = "Playing Game Time(Hour)",
        xlab = "",
        xlim = c(0,2)
)

barplot(agreeEffectFreq,
        col = rainbow(length(agreeEffectFreq)),
        ylab = "Frequency",
        ylim = c(0,40),
        main = "Respondents' Opinion about Games Effect the Student Academic Performance"
)

barplot(agreeHabitFreq,
        col = rainbow(length(agreeHabitFreq)),
        ylab = "Frequency",
        ylim = c(0,30),
        main = "Respondents' Opinion about the Bad Habits of Playing Video Games"
)

barplot(agreeBenefitFreq,
        col = rainbow(length(agreeBenefitFreq)),
        ylab = "Frequency",
        ylim = c(0,40),
        main = "Respondents' Opinion about the Benefits of Playing Video Games"
)

pie3D(yesNoFreq,
      labels = names(yesNoFreq),
      col = rainbow(length(yesNoFreq)),
      main = "Respondents",
      explode = 0.09
)

