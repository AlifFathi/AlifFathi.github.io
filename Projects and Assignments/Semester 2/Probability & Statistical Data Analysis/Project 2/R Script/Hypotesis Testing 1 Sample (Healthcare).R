library(readxl)
HEALTHCARE_1 <- read_excel("HEALTHCARE 1.xlsx")

# Population mean with Known Variance (Two Tailed)

data1 <- HEALTHCARE_1$BMI
data1

n <- 579
alpha <- 0.05
mu <- 30.0

# Calculate mean and standard deviation
xdata <- mean(data1)
datasd <- sd(data1)

# Calculate Z statistics
n
datasd
xdata
mu
z <- (xdata-mu) / (datasd/sqrt(n))
z

# Calculate critical value on both side
alpha
z.alpha <- qnorm(1-alpha/2)
c(-z.alpha, z.alpha)


