use("libraryDB");

// 1. Total number of books
// Counts the total number of documents in the books collection
db.books.aggregate([{ $count: "totalBooks" }])

// 2. Total unpaid fines per user
// Filters fines to only include unpaid status, groups by userId, 
// calculates the sum of fine amounts, and sorts results in descending order by total fine amount
db.fines.aggregate([{ $match: { "payment.status": "UNPAID" } },
{ $group: { _id: "$userId", totalFine: { $sum: "$amount" } } },
{ $sort: { totalFine: -1 } }])

// 3. Total books per category
// Unwinds the categories array to create a document for each category,
// groups by category, and sums the total number of books for each category
db.books.aggregate([{ $unwind: "$categories" },
{ $group: { _id: "$categories", totalBooks: { $sum: 1 } } },
{ $sort: { _id: 1 } }])

// 4. Top 3 users with the highest number of books borrowed
// Groups loans by userId, counts the number of times each user has borrowed a book,
// and sorts results in descending order by the count
db.loans.aggregate([{ $group: { _id: "$userId", totalBorrows: { $sum: 1 } } },
{ $sort: { totalBorrows: -1 } },
{ $limit: 3 }])

