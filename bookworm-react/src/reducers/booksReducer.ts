import { createSlice, PayloadAction } from "@reduxjs/toolkit";
import { Book } from 'types/books.t';

interface BooksState {
    bestSellers: Book[]
    favourites: Book[]
    searchResults: Book[]
}

const initialState: BooksState = {
    bestSellers: [],
    favourites: [],
    searchResults: []
}

const booksReducer = createSlice({
    name: 'books',
    initialState,
    reducers: {
        setBestSellers: (state, action: PayloadAction<Book[]>) => {
            state.bestSellers = action.payload
        },
        setFavourites: (state, action: PayloadAction<Book[]>) => {
            state.favourites = action.payload
        },
        setSearchResults: (state, action: PayloadAction<Book[]>) => {
            state.searchResults = action.payload
        }
    }
})

export const { setBestSellers, setFavourites, setSearchResults } = booksReducer.actions

export const selectBestSellers = (state: BooksState) => state.bestSellers
export const selectFavourites = (state: BooksState) => state.favourites
export const selectSearchResults = (state: BooksState) => state.searchResults

export default booksReducer.reducer