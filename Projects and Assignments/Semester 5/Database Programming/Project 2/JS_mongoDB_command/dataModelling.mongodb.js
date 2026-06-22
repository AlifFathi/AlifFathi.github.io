use('libraryDB');

db.users.drop()
db.books.drop()
db.loans.drop()
db.fines.drop()

db.createCollection("users")
db.createCollection("books")
db.createCollection("loans")
db.createCollection("fines")

db.users.insertOne({
    _id: "A23CS0001",
    name: "Sabrina Carpenter",
    email: "sabrina@utm.edu.my",
    contact: "0123456789",
    address: {
        street: "123 Jalan Melati",
        city: "Muar",
        state: "Johor",
    },
    borrowHistory: [],
    createdAt: new Date("2024-11-20")
})

db.books.insertOne({
    _id: "B001",
    title: "Database Systems Concepts",
    authors: ["Abraham Silberschatz", "Henry Korth"],
    categories: ["Database", "Computer Science"],
    publisher: {
        name: "McGraw-Hill",
        year: 2021
    },
    createdAt: new Date("2024-10-15")
})

db.loans.insertOne({
    _id: "L001",
    userId: "A23CS0001",
    bookId: "B001",
    loanDate: new Date("2024-12-01"),
    dueDate: new Date("2024-12-14"),
    returnDate: null,
    status: "BORROWED"
})

db.fines.insertOne({
    _id: "F001",
    loanId: "L001",
    userId: "A23CS0001",
    amount: 5.00,
    reason: "Late return",
    payment: {
        status: "UNPAID",
        method: null
    },
    issuedDate: new Date("2024-12-16")
})


