import React from "react";
import Todos from "./components/Todos/Todos";
import "./App.css";
import { Layout, Menu } from "antd";
import { Routes, Route, Link } from "react-router-dom";
import EditTodo from "./components/Todos/EditTodo";
import NewTodo from "./components/Todos/NewTodo";
const { Header, Content, Footer, Sider } = Layout;

function App() {
  const menuItem = [
    {
      label: <Link to="/todos-list">Todos List</Link>,
      key: "todos-list",
    },
    {
      label: <Link to="/new-todo">New Todo</Link>,
      key: "new-todo",
    },
  ];

  return (
    <Layout>
      <Sider breakpoint="lg" collapsedWidth="0">
        <div className="logo" style={{ marginBottom: 50 }} />
        <Menu
          theme="dark"
          mode="inline"
          defaultSelectedKeys={["1"]}
          items={menuItem}
        />
      </Sider>
      <Layout>
        <Header
          className="site-layout-sub-header-background"
          style={{
            padding: 0,
          }}
        />
        <Content
          style={{
            margin: "24px 16px 0",
          }}
        >
          <div className="site-layout-content">
            <Routes>
              <Route path="todos-list" element={<Todos />} />
              <Route path="todos-list/edit/:id" element={<EditTodo />} />
              <Route path="new-todo" element={<NewTodo />} />
            </Routes>
          </div>
        </Content>
        <Footer
          style={{
            textAlign: "center",
          }}
        >
          Todo App ©2022
        </Footer>
      </Layout>
    </Layout>
  );
}

export default App;

/*(
    <Layout className="layout">
      <Header>
        <div className="logo"></div>
        <Menu
          theme="dark"
          mode="horizontal"
          defaultSelectedKeys={["2"]}
          items={menuItem}
        />
      </Header>
      <Content style={{ padding: "0 75px", marginTop: 25 }}>
        <div className="site-layout-content">
          <Routes>
            <Route path="/todos-list" element={<Todos />} />
          </Routes>
        </div>
      </Content>
      {<Footer style={{ textAlign: "center" }}>©2022</Footer>}
    </Layout>
  );*/
