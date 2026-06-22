# Load necessary library
library(readxl)

# Read the Excel file
HEALTHCARE_1 <- read_excel("C:/Users/Owner/Desktop/PSDA PROJECTO 2/HEALTHCARE 1.xlsx")

# View the data (this will open the data in a new window in RStudio)
View(HEALTHCARE_1)

# Extract BMI and SleepHours columns
x_value <- HEALTHCARE_1$BMI
y_value <- HEALTHCARE_1$SleepHours

# Calculate correlation between BMI and SleepHours
correlation <- cor(x_value, y_value, use = "complete.obs") # Ensure handling of missing values
print(correlation)

# Plot BMI vs SleepHours
plot(x_value, y_value,
     xlab = "BMI",
     ylab = "Sleep Hours",
     main = "Correlation between BMI and Sleep Hours",
     pch = 19) # Add point character for better visibility

