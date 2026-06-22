use("libraryDB");

// Update loan with _id "L004" to change bookId, loanDate, dueDate, and status using $set
db.loans.updateOne({_id: "L004"}, 
    {$set: {
        bookId: "B004",
        loanDate: new Date("2024-12-12"),
        dueDate: new Date("2024-12-26"),
        status: "BORROWED"
    }}
)

// Increase fine amount by 2.0 for all fines with payment status "UNPAID" using $inc
db.fines.updateMany({"payment.status": "UNPAID"},
    {$inc: {amount: 2.0}}
)

// Add a bookId to the borrowHistory array of user with _id "A23CS0004" using $push
db.users.updateOne({_id: "A23CS0004"},
    {$push: {borrowHistory: "B005"}}
)

// Remove "Clifford Stein" from the authors array of the book titled "Introduction to Algorithms" using $pull
db.books.updateOne({title: "Introduction to Algorithms"},
    {$pull: {authors: "Clifford Stein"}}
)

// Delete the fine with _id "F003"
db.fines.deleteOne({_id: "F003"})

// Delete all fines with payment status "PAID"
db.fines.deleteMany({"payment.status": "PAID"})