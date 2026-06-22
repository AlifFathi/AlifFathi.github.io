use("libraryDB");

// Insert a new user into the users collection using insertOne()
db.users.insertOne({
    _id: "A23CS0002",
    name: "Danial Afiq",
    email: "dani@example.com",
    contact: "0198765432",
    address: {
        street: "456 Jalan Kenanga",
        city: "Kuala Lumpur",
        state: "Selangor"
    },
    borrowHistory: ["B001", "B004"],
    createdAt: new Date("2024-12-01")
})

// Insert multiple users into the users collection using insertMany()
db.users.insertMany([{
    _id: "A23CS0003",
    name: "Fathi Alif",
    email: "fathi@example.com",
    contact: "0198765433",
    address: {
        street: "789 Jalan Seri",
        city: "Kuching",
        state: "Sarawak"
    },
    borrowHistory: ["B003", "B006"],
    createdAt: new Date("2024-12-01")
},
{
    _id: "A23CS0004",
    name: "Abadi Iman",
    email: "abadi@example.com",
    contact: "0198767434",
    address: {
        street: "101 Jalan Seri",
        city: "Kota Bharu",
        state: "Kelantan"
    },
    borrowHistory: ["B002"],
    createdAt: new Date("2024-12-01")
}])

// Insert multiple books into the books collection using insertMany()
db.books.insertMany([{
    _id: "B002",
    title: "Introduction to Algorithms",
    authors: ["Thomas H. Cormen", "Charles E. Leiserson", "Ronald L. Rivest", "Clifford Stein"],
    categories: ["Algorithms", "Computer Science", "Programming"],
    publisher: {
        name: "MIT Press",
        year: 2022
    },
    createdAt: new Date("2019-01-20")
}, 
{
    _id: "B003",
    title: "Advanced Mathematics",
    authors: ["Richard G. Brown"],
    categories: ["Mathematics", "Advanced Studies"],
    publisher: {
        name: "Springer",
        year: 2020
    },
    createdAt: new Date("2020-03-15")
},
{
    _id: "B004",
    title: "Software Engineering",
    authors: ["Ian Sommerville"],
    categories: ["Software Engineering", "Computer Science"],
    publisher: {
        name: "Pearson",
        year: 2023
    },
    createdAt: new Date("2020-07-09")
},
{
    _id: "B005",
    title: "49 Power of Law",
    authors: "Robert Greene",
    categories: ["Self-Help", "Psychology"],
    publisher: {
        name: "Viking Press",
        year: 2020
    },
    createdAt: new Date("2020-09-01")
},
{
    _id: "B006",
    title: "Introduction to Database Systems",
    authors: ["Abraham Silberschatz", "Henry F. Korth", "S. Sudarshan"],
    categories: ["Database", "Computer Science"],
    publisher: {
        name: "McGraw-Hill",
        year: 2015
    },
    createdAt: new Date("2014-01-15")
}])

// Insert multiple loans into the loans collection using insertMany()
db.loans.insertMany([{
    _id: "L002",
    userId: "A23CS0002",
    bookId: "B002",
    loanDate: new Date("2024-12-05"),
    dueDate: new Date("2024-12-19"),
    returnDate: null,
    status: "BORROWED"
},
{
    _id: "L003",
    userId: "A23CS0003",
    bookId: "B003",
    loanDate: new Date("2024-11-25"),
    dueDate: new Date("2024-12-09"),
    returnDate: new Date("2024-12-08"),
    status: "RETURNED"
},
{
    _id: "L004",
    userId: "A23CS0004",
    bookId: null,
    loanDate: null,
    dueDate: null,
    returnDate: null,
    status: "PENDING"
},
{
    _id: "L005",
    userId: "A23CS0004",
    bookId: "B005",
    loanDate: new Date("2024-12-10"),
    dueDate: new Date("2024-12-24"),
    returnDate: new Date("2024-12-24"),
    status: "RETURNED"
}])

// Insert multiple fines into the fines collection using insertMany()
db.fines.insertMany([{
    _id: "F002",
    loanId: "L002",
    userId: "A23CS0002",
    amount: 7.50,
    reason: "Damaged book cover",
    payment: {
        status: "PAID",
        method: "CASH"
    },
    issuedDate: new Date("2024-12-10")
},
{
    _id: "F003",
    loanId: "L003",
    userId: "A23CS0003",
    amount: 0.00,
    reason: "No fine",
    payment: {
        status: null,
        method: null
    },
    issuedDate: new Date("2024-12-08")
},
{
    _id: "F004",
    loanId: "L005",
    userId: "A23CS0004",
    amount: 22.50,
    reason: "Lost book",
    payment: {
        status: "UNPAID",
        method: null
    },
    issuedDate: new Date("2024-12-25")
}])